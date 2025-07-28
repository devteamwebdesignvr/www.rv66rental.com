<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $table = "blogs";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'title',
		'seo_url',
		'image',
		'publish',
		'longDescription',
		'shortDescription',
		'meta_description',
		'meta_keywords',
		'meta_title',
		'featureImage',
		'blog_category_id',
		'agent_id',


		'title_ger',
		'longDescription_ger',
		'shortDescription_ger',
		'meta_description_ger',
		'meta_keywords_ger',
		'meta_title_ger',
		'status'


    ];

    public static $rules = [
        // create rules
    ];

    public function blogCategory(){
        return $this->belongsTo(\App\Models\Blogs\BlogCategory::class,"blog_category_id","id");
    }
}
