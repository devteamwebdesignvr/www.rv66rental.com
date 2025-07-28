<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs\Blog;
use App\Helper\Upload;
use Validator;
use Carbon\Carbon;

class BlogController extends Controller{
    
    public function __construct(Blog $model){
        $this->model=$model;
        $this->admin_base_url="blogs.index";
        $this->admin_view="admin.blogs";
    }
    public function active($id){
        $data=$this->model::find($id);
        if($data){
            $data->status="active";
            $data->save();
            return redirect()->route($this->admin_base_url)->with("success","Successfully active");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
    public function deactive($id){
        $data=$this->model::find($id);
        if($data){
            $data->status="deactive";
            $data->save();
            return redirect()->route($this->admin_base_url)->with("success","Successfully deactive");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
    
    public function copyData($id){
        $data=$this->model::find($id);
        if($data){
            
            $newPost = $data->replicate();
            $newPost->seo_url=$data->seo_url.'-copy';
            $newPost->created_at = Carbon::now();
            $newPost->save();
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
        $validator = Validator::make($request->all(), [
            'seo_url' => 'required|unique:blogs,seo_url',
            'blog_category_id'=>"required",
            'title' => 'required'
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        if ($request->hasFile("image")) {
            $data['image'] = Upload::fileUpload($request->file("image"),"blogs");
        }
        if ($request->hasFile("featureImage")) {
            $data['featureImage'] = Upload::fileUpload($request->file("featureImage"),"blogs");
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
            'seo_url' => 'required|unique:blogs,seo_url,'.$id,
            'blog_category_id'=>"required",
            'title' => 'required'
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            if ($request->hasFile("image")) {
                $data['image'] = Upload::fileUpload($request->file("image"),"blogs");
            }
            if ($request->hasFile("featureImage")) {
                $data['featureImage'] = Upload::fileUpload($request->file("featureImage"),"blogs");
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
