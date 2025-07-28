<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CheckinConfig;
use App\Helper\Upload;
use Validator;
use Carbon\Carbon;

class CheckinConfigController extends Controller{
    
    public function __construct(CheckinConfig $model){
        $this->model=$model;
        $this->admin_base_url="check_in_configs.index";
        $this->admin_view="admin.check_in_configs";
    }
    
    public function index(){
        $data=$this->model::orderBy("id","desc")->get();
        return view($this->admin_view.".index",compact("data"));
    }
    
    public function create(){
        return view($this->admin_view.".create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), []);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        if ($request->hasFile("image")) {
            $data['image'] = Upload::fileUpload($request->file("image"),"check_in_configs");
        }
        if ($request->hasFile("bannerImage")) {
            $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"check_in_configs");
        }
        if($request->start_date){
            if($request->end_date){
                $now = strtotime($request->start_date); 
                $your_date = strtotime($request->end_date);
                $datediff =  $your_date-$now;
                $day= ceil($datediff / (60 * 60 * 24));
                 $total_night=$day;
                 if($day>0){
                     for($i=0;$i<$day;$i++){
                        $date = strtotime($request->start_date);
                        $date = strtotime("+".$i." day", $date);
                        $date=date('Y-m-d',$date);
                        $ar=['date_data'=>$date,"name"=>$request->name,"type"=>$request->type];
                        $this->model::create($ar);
                    }
                }
            }
        }else{
            $this->model::create($data);
        }
        return redirect()->route($this->admin_base_url)->with("success","Successfully Added");
    }
  
    public function show($id){
        return redirect()->route($this->admin_base_url);
    }

    public function copyData($id){
        $data=$this->model::find($id);
        if($data){
            $newPost = $data->replicate();
            $newPost->created_at = Carbon::now();
            $newPost->save();
            return redirect()->route($this->admin_base_url)->with("success","Successfully Coppied");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function edit($id){
        $data=$this->model::find($id);
        if($data){
            return view($this->admin_view.".edit",compact("data"));
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
  
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), []);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            if ($request->hasFile("image")) {
                $data['image'] = Upload::fileUpload($request->file("image"),"check_in_configs");
            }
            if ($request->hasFile("bannerImage")) {
                $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"check_in_configs");
            }
            $this->model::find($id)->update($data);
            return redirect()->route($this->admin_base_url)->with("success","Successfully Updated");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function destroy($id){
        $exist=$this->model::find($id);
        if($exist){
            $exist->delete();
            return redirect()->route($this->admin_base_url)->with("success","Successfully Deleted");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
}