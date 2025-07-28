<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $table = "payments";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'booking_id',
        'receipt_url',
        'customer_id',
        'balance_transaction',
        'tran_id',
        'description',
        'main_response',
        'status',
        'type',
        'amount'
    ];
}
