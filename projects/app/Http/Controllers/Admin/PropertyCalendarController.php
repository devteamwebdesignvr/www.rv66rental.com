<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IcalEvent;
use App\Models\IcalImportList;
use App\Models\Property;
use App\Helper\Upload;
use Validator;
use LiveCart;
use Carbon\Carbon;

class PropertyCalendarController extends Controller{
    
    public function __construct(IcalEvent $model){
        $this->model=$model;
        $this->admin_base_url="properties-calendar";
        $this->admin_view="admin.properties-calendar";
    }

    function selfIcalRefresh(Request $request,$id){
        LiveCart::getFileIcalFileData($id);
        return redirect()->back()->with("success","successfully refresh self ical");
    }

    function importlist(Request $request,$property_id){
        $property=Property::find($property_id);
        if($property):
            $data=IcalImportList::where("property_id",$property_id)->orderBy("id","desc")->get();
            return view($this->admin_view.".importlist",compact("data","property_id","property"));
        else:
            return redirect()->route("properties.index");
        endif;
    }
    
    public function index($property_id){
        $property=Property::find($property_id);
        if($property):
            $data=$this->model::where("event_pid",$property_id)->orderBy("id","desc")->get();
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
        $validator = Validator::make($request->all(), ['ical_link' => 'required|unique:ical_import_list,ical_link',]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        if ($request->hasFile("image")) {
            $data['image'] = Upload::fileUpload($request->file("image"),"properties-calendar");
        }
        if ($request->hasFile("bannerImage")) {
            $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"properties-calendar");
        }
        $data['property_id']=$property_id;
        $ical_list=IcalImportList::create($data);
        LiveCart::refreshIcalData($property_id,$ical_list->ical_link,$ical_list->id,$ical_list->color);
        return redirect()->route($this->admin_base_url.'.index',[$property_id])->with("success","Successfully Added");
    }

    function importlistRefresh($property_id,$id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->back()->with("danger","invalid calling");
        }
        $ical_list=IcalImportList::find($id);
        if($ical_list){
            LiveCart::refreshIcalData($property_id,$ical_list->ical_link,$ical_list->id,$ical_list->color);
            return redirect()->back()->with("success","Successfully Refreshed");
        }else{
            return redirect()->back()->with("danger","invalid calling");
        }
    }

    public function destroy($property_id,$id){
        $property=Property::find($property_id);
        if($property){}else{
            return redirect()->route("properties.index");
        }
        $exist=IcalImportList::find($id);
        if($exist){
            IcalEvent::where("ical_link",$exist->ical_link)->delete();
            $exist->delete();
            return redirect()->back()->with("success","Successfully Deleted");
        }
        return redirect()->back()->with("danger","Invalid Calling");
    }
}