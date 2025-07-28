<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyExtraOptionRate extends Model
{
    use HasFactory;

    public $fillable=[
        "property_id",
        "option_name",
        "option_rate",
        "option_status",
    ];
}
