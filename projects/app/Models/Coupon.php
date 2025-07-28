<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $table = "coupons";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'name',
		'description',
		'code',
		'amount',
		'type',
		'property_id',
		'start_date',
		'end_date',
		'start_timestamp',
		'end_timestamp'
		

    ];

    public static $rules = [
        // create rules
    ];

    // Cm 
}

