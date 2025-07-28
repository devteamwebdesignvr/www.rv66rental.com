<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $table = "galleries";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [	
    	"image",
    	'type',
    	'thumbnail',
    	'status'
    ];
}
