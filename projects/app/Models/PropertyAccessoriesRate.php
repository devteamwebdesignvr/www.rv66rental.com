<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAccessoriesRate extends Model
{
    use HasFactory;

    public $fillable=[
        "property_id",
        "accessories_name",
        "accessories_helping_text",
        "accessories_rate",
        "accessories_type",
        "accessories_status",
    ];
}
