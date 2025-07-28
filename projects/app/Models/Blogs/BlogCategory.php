<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public $table = "blog_categories";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'title',
        'seo_url',
        'image',
        'shortDescription',
        'benefits',
        'longDescription',
        'isHome',
        'publish',
        'isParent',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'bannerImage',
        'ordering',
        'templete',

'title_ger',
'shortDescription_ger',
'benefits_ger',
'longDescription_ger',
'meta_title_ger',
'meta_keywords_ger',
'meta_description_ger',

    ];

    public static $rules = [
        // create rules
    ];

    // BlogCategory 

    public function blog(){
        return $this->hasMany(\App\Models\Blogs\Blog::class,"blog_category_id","id");
    }
}
