<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Helper\Upload;
use Validator;
use Helper;

class LocationController extends Controller{
    
    public function __construct(Location $model){
        $this->model=$model;
        $this->admin_base_url="locations.index";
        $this->admin_view="admin.locations";
    }

    
    public function index(){
        $data=$this->model::orderBy("id","desc")->get();
        return view($this->admin_view.".index",compact("data"));
    }

    
    public function create(){
        return view($this->admin_view.".create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'seo_url' => 'required|unique:locations,seo_url',
            'name' => 'required'
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        if ($request->hasFile("image")) {
            $data['image'] = Upload::fileUpload($request->file("image"),"locations");
        }
        if ($request->hasFile("attraction_image")) {
            $data['attraction_image'] = Upload::fileUpload($request->file("attraction_image"),"locations");
        }


        if ($request->hasFile("bannerImage")) {
            $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"locations");
        }
        $this->model::create($data);
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
        $validator = Validator::make($request->all(), [
            'seo_url' => 'required|unique:locations,seo_url,'.$id,
            'name' => 'required'
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            if ($request->hasFile("image")) {
                Helper::deleteFile($exist->image);
                $data['image'] = Upload::fileUpload($request->file("image"),"locations");
            }
            
            if ($request->hasFile("attraction_image")) {
                Helper::deleteFile($exist->attraction_image);
                $data['attraction_image'] = Upload::fileUpload($request->file("attraction_image"),"locations");
            }
            if ($request->hasFile("bannerImage")) {
                Helper::deleteFile($exist->bannerImage);
                $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"locations");
            }
            
            
            if($request->remove_attraction_image){
                $data['attraction_image'] ='';
                Helper::deleteFile($exist->attraction_image);
            }
            
            if($request->remove_banner_image){
                $data['bannerImage'] ='';
                Helper::deleteFile($exist->bannerImage);
            }
            
            if($request->remove_image){
                $data['image'] ='';
                Helper::deleteFile($exist->image);
            }
            $this->model::find($id)->update($data);
            return redirect()->route($this->admin_base_url)->with("success","Successfully Updated");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function destroy($id){
        $exist=$this->model::find($id);
        if($exist){
            Helper::deleteFile($exist->attraction_image);
            Helper::deleteFile($exist->bannerImage);
            Helper::deleteFile($exist->image);
            $exist->delete();
            return redirect()->route($this->admin_base_url)->with("success","Successfully Deleted");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
}
