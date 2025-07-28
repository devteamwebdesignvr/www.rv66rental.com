<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomePackage extends Model
{
    public $table = "welcome_packages";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
	
		
		'longDescription',
		
		'image',
		
		
		'bannerImage',
		
		'location_id'

    ];

    public static $rules = [
        // create rules
    ];

    // Cm 
}

