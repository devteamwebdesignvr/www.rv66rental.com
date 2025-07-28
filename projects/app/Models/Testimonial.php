<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Testimonial
 * @package App\Models
 */
class Testimonial extends Model
{
    public $table = "testimonials";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'name',
		'message',
		'image',
		'email',
		'mobile',
		'profile',
		'score',
		'stay_date',
		'property_id',
		'status'



    ]; 
}
