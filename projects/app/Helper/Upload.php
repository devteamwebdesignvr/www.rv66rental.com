<?php 
namespace App\Helper;
use ModelHelper;
use Image;
class Upload{

	public static function fileUpload($file,$path="uploads"){
        $path="uploads/".$path;
		$ext=$file->getClientOriginalExtension();
        $image=uniqid().'.'.$ext;
        $file->move(public_path($path),$image);
        $image_name=$path.'/'.$image;
        return $image_name;
	}

	public static function uploadData($file,$path="uploads/files"){
        $path="uploads/".$path;
		$ext=$file->getClientOriginalExtension();
        $image=uniqid().'.'.$ext;
        $file->move(public_path($path),$image);
        $image_name=$path.'/'.$image;
        return $image_name;
	}
       
    public static function uploadWithLogoImageData($file,$path="uploads/files"){
        $path="uploads/".$path;
        $ext=$file->getClientOriginalExtension();
        $image=uniqid().'.'.$ext;
        $file->move(public_path($path),$image);
        $image_name=$path.'/'.$image;
        return $image_name;
    }
}	