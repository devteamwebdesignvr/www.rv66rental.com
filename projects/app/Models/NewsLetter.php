<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    public $table = "newsletters";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
	
		'email',
	

    ];

    public static $rules = [
        // create rules
    ];

}
