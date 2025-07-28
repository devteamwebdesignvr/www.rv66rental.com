<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyRateGroup;
use App\Models\PropertyRate;
use App\Models\Property;
use ModelHelper;
use App\Helper\Upload;
use Validator;
use Carbon\Carbon;

class PropertyRateController extends Controller{
    
    public function __construct(PropertyRateGroup $model){
        $this->model=$model;
        $this->admin_base_url="properties-rates";
        $this->admin_view="admin.properties-rates";
    }

    
    public function index($property_id){
        $property=Property::find($property_id);
        if($property):
            $data=$this->model::where("property_id",$property_id)->orderBy("id","desc")->get();

            return view($this->admin_view.".index",compact("data","property_id","property"));
        else:
            return redirect()->route("properties.index");
        endif;
    }

    

    
    public function create($property_id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        return view($this->admin_view.".create",compact("property_id","property"));
    }

    public function store(Request $request,$property_id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        $validator = Validator::make($request->all(), [
            'start_date'=>"required",
            'end_date'=>"required"
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        
        $checker=PropertyRateGroup::where("start_date",$request->start_date)->where("property_id",$property_id)->first();
        if($checker){
             return redirect()->back()->withInput()->with("danger",'Start Date has already been taken.');
        }
        
        $checker=PropertyRateGroup::where("end_date",$request->end_date)->where("property_id",$property_id)->first();
        if($checker){
             return redirect()->back()->withInput()->with("danger",'End Date has already been taken.');
        }
        $data=$request->all();
            $data['start_date_timestamp']=strtotime($request->start_date);
            $data['end_date_timestamp']=strtotime($request->end_date);
            if($request->type_of_price=="default"){
                $data['monday_price']=null;
                $data['tuesday_price']=null;
                $data['wednesday_price']=null;
                $data['thrusday_price']=null;
                $data['friday_price']=null;
                $data['saturday_price']=null;
                $data['sunday_price']=null;
            }else{
                $data['price']=null;
                $data['base_price']=null;
            }

            
        
        $data=$this->model::create($data);
        ModelHelper::saveSIngleDatePropertyRate($request,$data->id);
        return redirect()->route($this->admin_base_url,[$property_id])->with("success","Successfully Added");
    }

  
    public function show($property_id,$id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        return redirect()->route($this->admin_base_url);
    }

    public function copyData($property_id,$id){
        $data=$this->model::find($id);
        if($data){
            
            $newPost = $data->replicate();
            $newPost->created_at = Carbon::now();
            $newPost->save();
            return redirect()->route($this->admin_base_url,[$property_id])->with("success","Successfully Coppied");
        }
        return redirect()->route($this->admin_base_url,[$property_id])->with("danger","Invalid Calling");
    }

    public function edit($property_id,$id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        $data=$this->model::find($id);
        if($data){
            return view($this->admin_view.".edit",compact("data","property_id","property"));
        }
        return redirect()->route($this->admin_base_url,[$property_id])->with("danger","Invalid Calling");
    }

  
    public function update(Request $request,$property_id, $id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        $validator = Validator::make($request->all(), [
             'start_date'=>"required",
            'end_date'=>"required",
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        
        
        $checker=PropertyRateGroup::where("start_date",$request->start_date)->where("id","!=",$id)->where("property_id",$property_id)->first();
        if($checker){
             return redirect()->back()->withInput()->with("danger",'Start Date has already been taken.');
        }
        
        $checker=PropertyRateGroup::where("end_date",$request->end_date)->where("id","!=",$id)->where("property_id",$property_id)->first();
        if($checker){
             return redirect()->back()->withInput()->with("danger",'End Date has already been taken.');
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            $data['start_date_timestamp']=strtotime($request->start_date);
            $data['end_date_timestamp']=strtotime($request->end_date);
            if($request->type_of_price=="default"){
                $data['monday_price']=null;
                $data['tuesday_price']=null;
                $data['wednesday_price']=null;
                $data['thrusday_price']=null;
                $data['friday_price']=null;
                $data['saturday_price']=null;
                $data['sunday_price']=null;
            }else{
                $data['price']=null;
                $data['base_price']=null;
            }
            $this->model::find($id)->update($data);
            ModelHelper::saveSIngleDatePropertyRate($request,$id);
            return redirect()->route($this->admin_base_url,[$property_id])->with("success","Successfully Updated");
        }
        return redirect()->route($this->admin_base_url,[$property_id])->with("danger","Invalid Calling");
    }

    public function destroy($property_id,$id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        $exist=$this->model::find($id);
        if($exist){
            PropertyRate::where("rate_group_id",$id)->delete();
            $exist->delete();
            return redirect()->route($this->admin_base_url,[$property_id])->with("success","Successfully Deleted");
        }
        return redirect()->route($this->admin_base_url,[$property_id])->with("danger","Invalid Calling");
    }
}
