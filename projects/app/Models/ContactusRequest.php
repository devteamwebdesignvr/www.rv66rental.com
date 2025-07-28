<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactusRequest extends Model
{
    public $table = "contactus_requests";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'first_name',
        'last_name', 
		'email',
		'mobile',
		'message',
      
		

    ];

    public static $rules = [
        // create rules
    ];

    // Cm 
}

