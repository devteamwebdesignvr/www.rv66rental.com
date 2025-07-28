<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMillageRate extends Model
{
    use HasFactory;

    public $fillable=[
        "property_id",
        "milleage_name",
        "milleage_rate",
        "milleage_status",
        'milleage_free',
        'milleage_format',
        'milleage_type'
    ];
}
