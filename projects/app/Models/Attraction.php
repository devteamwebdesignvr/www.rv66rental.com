<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    public $table = "attractions";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'name',
		'seo_url',
		'shortDescription',
		'mediumDescription',
		'longDescription',
		'description',
		'image',
		'meta_title',
		'meta_keywords',
		'meta_description',
		'templete',
		'bannerImage',
		'publish',

		'header_section',
		'footer_section',
		'location_id'

    ];

    public static $rules = [
        // create rules
    ];

    // Cm 
}

