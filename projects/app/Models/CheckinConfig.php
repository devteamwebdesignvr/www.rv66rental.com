<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinConfig extends Model
{
    public $table = "check_in_configs";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'name',
		'type',
		'date_data'
    ];
}
