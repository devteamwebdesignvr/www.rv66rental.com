<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $table = "sliders";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'title',
		'link',
		'image',
        'description',
  
        'cms_id'

      

    ];
 
    public static $rules = [
        // create rules
        
        'image'=>"required|image"
    ];
    public static $updaterules = [
        // create rules
              
        'image'=>"nullable|image"
      
    ];

    // Slider 
}
