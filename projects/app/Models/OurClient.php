<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurClient extends Model
{
    public $table = "our_clients";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'title',
		'image',
        'description'
       

    ];

    public static $rules = [
        // create rules
        'title'=>"required",
        'image'=>"required"

    ];
    public static $updaterules = [
        // create rules
        'title'=>"required",
        'image'=>"required"

    ];

    // OurClient 
}
