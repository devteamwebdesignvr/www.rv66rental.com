<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyGallery;
use App\Models\PropertyAmenityGroup;
use App\Models\PropertyAmenity;
use App\Models\PropertyFee;
use App\Models\PropertySpace;
use App\Models\PropertyRate;
use App\Models\PropertyRateGroup;
use App\Models\PropertyRoom;
use App\Models\BookingRequest;
use App\Models\PropertyMillageRate;
use App\Models\PropertyExtraOptionRate;
use App\Models\PropertyAccessoriesRate;
use Helper;
use App\Helper\Upload;
use Validator;
use LiveCart;
use Carbon\Carbon;

class PropertyController extends Controller{
    
    public function __construct(Property $model){
        $this->model=$model;
        $this->admin_base_url="properties.index";
        $this->admin_view="admin.properties";
    }
    
    public function active($id){
        $data=$this->model::find($id);
        if($data){
            $data->status="true";
            $data->save();
            return redirect()->route($this->admin_base_url)->with("success","Successfully active");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
    
    public function deactive($id){
        $data=$this->model::find($id);
        if($data){
            $data->status="false";
            $data->save();
            return redirect()->route($this->admin_base_url)->with("success","Successfully deactive");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
    
     function updateCaptionSOrt(Request $request){
        foreach($request->captionidsarray as $key=>$value){
            if(isset($value['id'])){
                $data=PropertyGallery::find($value['id']);
                if($data){
                    $data->sorting=$key;
                    if(isset($value['value']))
                    $data->caption=$value['value'];
                    $data->save();
                }
            }
        }
        echo "successfully update gallery";
    }
    
    public function copyData($id){
        $data=$this->model::find($id);
        if($data){
            $newPost = $data->replicate();
            $seo_url=$data->seo_url.'-'.uniqid().'-copy';
            $newPost->seo_url=$seo_url;
            $newPost->created_at = Carbon::now();
            $result=$newPost->save();
            if($result){
                $property=Property::where("seo_url",$seo_url)->first();
                $id1=$property->id;
                LiveCart::getFileIcalFileData($id1);
                $data=PropertyGallery::where("property_id",$id)->get();
                foreach($data as $c){
                    $asset=['image' =>$c->image,'property_id'=>$id1,'status'=>$c->status,'sorting'=>$c->sorting,'caption'=>$c->caption];
                    PropertyGallery::create($asset);
                }
                foreach(PropertyAmenityGroup::where("property_id",$id)->get() as $c){
                    $am_group=PropertyAmenityGroup::create(["property_id"=>$id1,"status"=>$c->status,"name"=>$c->name,"image"=>$c->image,"sorting"=>$c->sorting]);
                    foreach(PropertyAmenity::where("property_amenity_id",$c->id)->get() as $c1){
                        PropertyAmenity::create(["property_amenity_id"=>$am_group->id,"name"=>$c1->name,"status"=>$c1->status,"image"=>$c1->image,"sorting"=>$c1->sorting]);
                    }
                }
            }
            return redirect()->route($this->admin_base_url)->with("success","Successfully Coppied");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
    
    public function index(){
        $data=$this->model::orderBy("id","desc")->get();
        return view($this->admin_view.".index",compact("data"));
    }
    
    public function create(){
        return view($this->admin_view.".create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), ['seo_url' => 'required|unique:properties,seo_url','name' => 'required']);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        if ($request->hasFile("banner_image")) {
            $data['banner_image'] = Upload::fileUpload($request->file("banner_image"),"properties");
        }
        if ($request->hasFile("feature_image")) {
            $data['feature_image'] = Upload::uploadWithLogoImageData($request->file("feature_image"),"properties");
        }
        if ($request->hasFile("welcome_package_attachment")) {
            $data['welcome_package_attachment'] = Upload::uploadWithLogoImageData($request->file("welcome_package_attachment"),"properties");
        }
        if ($request->hasFile("rental_aggrement_attachment")) {
            $data['rental_aggrement_attachment'] = Upload::uploadWithLogoImageData($request->file("rental_aggrement_attachment"),"properties");
        }
        $result=$this->model::create($data);
        if($result){
            $id=$result->id;
            LiveCart::getFileIcalFileData($id);
             if($request->file("images")){
                foreach($request->file("images") as $key1=>$image){
                    if($request->file("images")[$key1]){
                        $asset=['image' =>Upload::uploadWithLogoImageData($request->file("images")[$key1]),'property_id'=>$id,];
                        PropertyGallery::create($asset);
                    }
                }
            }
            PropertyFee::where("property_id",$id)->delete();
            if($request->fee_name){
                foreach($request->fee_name as $key => $value){
                    $ar=["property_id"=>$id,"fee_name"=>$request->fee_name[$key],"fee_rate"=>$request->fee_rate[$key],"fee_type"=>$request->fee_type[$key],"fee_apply"=>$request->fee_apply[$key],"fee_status"=>$request->fee_status[$key]];
                    PropertyFee::create($ar);
                }
            }
            PropertyMillageRate::where("property_id",$id)->delete();
            if($request->milleage_name){
                foreach($request->milleage_name as $key => $value){
                    $ar=["property_id"=>$id,"milleage_name"=>$request->milleage_name[$key],"milleage_rate"=>$request->milleage_rate[$key],"milleage_status"=>$request->milleage_status[$key],"milleage_free"=>$request->milleage_free[$key],"milleage_format"=>$request->milleage_format[$key]];
                    PropertyMillageRate::create($ar);
                }
            }
            PropertyExtraOptionRate::where("property_id",$id)->delete();
            if($request->option_name){
                foreach($request->option_name as $key => $value){
                    $ar=["property_id"=>$id,"option_name"=>$request->option_name[$key],"option_rate"=>$request->option_rate[$key],"option_status"=>$request->option_status[$key]];
                    PropertyExtraOptionRate::create($ar);
                }
            }
            PropertyAccessoriesRate::where("property_id",$id)->delete();
            if($request->accessories_name){
                foreach($request->accessories_name as $key => $value){
                    $ar=["property_id"=>$id,"accessories_name"=>$request->accessories_name[$key],"accessories_helping_text"=>$request->accessories_helping_text[$key],"accessories_rate"=>$request->accessories_rate[$key],"accessories_type"=>$request->accessories_type[$key],"accessories_status"=>$request->accessories_status[$key]];
                    PropertyAccessoriesRate::create($ar);
                }
            }
            PropertySpace::where("property_id",$id)->delete();
            if($request->space_name){
                foreach($request->space_name as $key => $value){
                    $ar=["property_id"=>$id,"space_name"=>$request->space_name[$key],"space_status"=>$request->space_status[$key]];
                    if($request->file("space_image")[$key]){
                        $ar['space_image']=Upload::uploadWithLogoImageData($request->file("space_image")[$key]);
                    }
                    PropertySpace::create($ar);
                }
            }
        }
        return redirect()->route($this->admin_base_url)->with("success","Successfully Added");
    }
  
    public function show($id){
        return redirect()->route($this->admin_base_url);
    }
   
    public function edit($id){
        $data=$this->model::find($id);
        if($data){
            return view($this->admin_view.".edit",compact("data"));
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
  
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), ['seo_url' => 'required|unique:properties,seo_url,'.$id,'name' => 'required']);  
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            if ($request->hasFile("banner_image")) {
                Helper::deleteFile($exist->bannerImage);
                $data['banner_image'] = Upload::fileUpload($request->file("banner_image"),"properties");
            }
            if ($request->hasFile("feature_image")) {
                Helper::deleteFile($exist->feature_image);
                $data['feature_image'] = Upload::uploadWithLogoImageData($request->file("feature_image"),"properties");
            }
            if ($request->hasFile("welcome_package_attachment")) {
                Helper::deleteFile($exist->welcome_package_attachment);
                $data['welcome_package_attachment'] = Upload::uploadWithLogoImageData($request->file("welcome_package_attachment"),"properties");
            }
            if ($request->hasFile("rental_aggrement_attachment")) {
                $data['rental_aggrement_attachment'] = Upload::uploadWithLogoImageData($request->file("rental_aggrement_attachment"),"properties");
            }
            if($request->remove_banner_image){
                $data['bannerImage'] ='';
                Helper::deleteFile($exist->bannerImage);
            }
            if($request->remove_rental_aggrement_attachment){
                $data['rental_aggrement_attachment'] ='';
                Helper::deleteFile($exist->rental_aggrement_attachment);
            }
            if($request->remove_welcome_package_attachment){
                $data['welcome_package_attachment'] ='';
                Helper::deleteFile($exist->welcome_package_attachment);
            }
            if($request->remove_feature_image){
                $data['feature_image'] ='';
                Helper::deleteFile($exist->feature_image);
            }
            $this->model::find($id)->update($data);
            LiveCart::getFileIcalFileData($id);
            if($request->preloaded){
                PropertyGallery::whereNotIn("id",$request->preloaded)->delete();
            }
             if($request->file("images")){
                foreach($request->file("images") as $key1=>$image){
                    if($request->file("images")[$key1]){
                        $asset=['image' =>Upload::uploadWithLogoImageData($request->file("images")[$key1]),'property_id'=>$id,];
                        PropertyGallery::create($asset);
                    }
                }
            }
            PropertyFee::where("property_id",$id)->delete();
            if($request->fee_name){
                foreach($request->fee_name as $key => $value){
                    $ar=["property_id"=>$id,"fee_name"=>$request->fee_name[$key],"fee_rate"=>$request->fee_rate[$key],"fee_type"=>$request->fee_type[$key],"fee_apply"=>$request->fee_apply[$key],"fee_status"=>$request->fee_status[$key],];
                    PropertyFee::create($ar);
                }
            }
            if($request->milleage_name){
                foreach($request->milleage_name as $key => $value){
                    $ar=[
                        "property_id"=>$id,
                        "milleage_name"=>$request->milleage_name[$key],
                        "milleage_rate"=>$request->milleage_rate[$key],
                        "milleage_status"=>$request->milleage_status[$key],
                        "milleage_free"=>$request->milleage_free[$key],
                        "milleage_format"=>$request->milleage_format[$key]
                    ];
                    if(isset($request->millage_id[$key])){
                        if( PropertyMillageRate::find($request->millage_id[$key]))
                        PropertyMillageRate::find($request->millage_id[$key])->update($ar);
                    }else{
                        PropertyMillageRate::create($ar);    
                    }
                }
            }
            if($request->option_name){
                foreach($request->option_name as $key => $value){
                    $ar=["property_id"=>$id,"option_name"=>$request->option_name[$key],"option_rate"=>$request->option_rate[$key],"option_status"=>$request->option_status[$key]];
                    if(isset($request->option_id[$key])){
                        if(PropertyExtraOptionRate::find($request->option_id[$key]))
                        PropertyExtraOptionRate::find($request->option_id[$key])->update($ar);
                    }else{
                        PropertyExtraOptionRate::create($ar);    
                    }
                }
            }
            if($request->accessories_name){
                foreach($request->accessories_name as $key => $value){
                    $ar=["property_id"=>$id,"accessories_name"=>$request->accessories_name[$key],"accessories_helping_text"=>$request->accessories_helping_text[$key],"accessories_rate"=>$request->accessories_rate[$key],"accessories_type"=>$request->accessories_type[$key],"accessories_status"=>$request->accessories_status[$key]];
                    if(isset($request->accessories_id[$key])){
                        if(PropertyAccessoriesRate::find($request->accessories_id[$key]))
                        PropertyAccessoriesRate::find($request->accessories_id[$key])->update($ar);
                    }else{
                        PropertyAccessoriesRate::create($ar);    
                    }
                }
            }
            if($request->space_name){
                foreach($request->space_name as $key => $value){
                    $ar=["property_id"=>$id,"space_name"=>$request->space_name[$key],"space_status"=>$request->space_status[$key]];
                    if($request->file("space_image")){
                        if(isset($request->file("space_image")[$key])){
                            $ar['space_image']=Upload::uploadWithLogoImageData($request->file("space_image")[$key]);
                        }
                    }
                    if(isset($request->space_id[$key])){
                        $ar12=PropertySpace::find($request->space_id[$key]);
                        if($ar12){
                            $ar12->update($ar);
                        }
                    }else{
                        PropertySpace::create($ar);
                    }
                }
            }
            return redirect()->back()->with("success","Successfully Updated");
        }
        return redirect()->back()->with("danger","Invalid Calling");
    }

    public function destroy($id){
        $exist=$this->model::find($id);
        if($exist){
            Helper::deleteFile($exist->bannerImage);
            Helper::deleteFile($exist->rental_aggrement_attachment);
            Helper::deleteFile($exist->welcome_package_attachment);
            Helper::deleteFile($exist->feature_image);
            foreach(PropertyAmenityGroup::where("property_id",$id)->get() as $c){
                PropertyAmenity::where("property_amenity_id",$c->id)->delete();
                $c->delete();
            }
            PropertyFee::where("property_id",$id)->delete();
            foreach(PropertyGallery::where("property_id",$id)->get() as $data){
                Helper::deleteFile($data->image);
            }
            PropertyGallery::where("property_id",$id)->delete();
            PropertyRate::where("property_id",$id)->delete();
            PropertyRateGroup::where("property_id",$id)->delete();
            PropertyRoom::where("property_id",$id)->delete();
            PropertySpace::where("property_id",$id)->delete();
            BookingRequest::where("property_id",$id)->delete();
            $exist->delete();
            return redirect()->route($this->admin_base_url)->with("success","Successfully Deleted");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    function imageDeleteAsset(Request $request){
        $data=PropertyGallery::find($request->id);
        if($data){
            Helper::deleteFile($data->image);
            $data->delete();
        }
    }

    function  deletePropertySpace(Request $request){
        if($request->id){
            $data=  PropertySpace::find($request->id);
            if($data){
                $data->delete();
            }
        }
    }

    function  deleteMillage(Request $request){
        if($request->id){
            $data=  PropertyMillageRate::find($request->id);
            if($data){
                $data->delete();
            }
        }
    }

    function  deleteoption(Request $request){
        if($request->id){
            $data=  PropertyExtraOptionRate::find($request->id);
            if($data){
                $data->delete();
            }
        }
    }

    function  deleteaccessories(Request $request){
        if($request->id){
            $data=  PropertyAccessoriesRate::find($request->id);
            if($data){
                $data->delete();
            }
        }
    }
}