<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFee extends Model
{
    use HasFactory;
    public $table = "property_fees";

    public $primaryKey = "id";

    public $timestamps = true;
    public $fillable=[
        "property_id",
        "fee_name",
        "fee_rate",
        "fee_type",
        "fee_apply",
        "fee_status",
    ];
}
