<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;
    public $fillable=[
            "property_id",
            "checkin",
            "checkout",
            "total_guests",
            "adults",
            "child",
            "gross_amount",
            "total_night",
            "sub_amount",
            "total_amount",
            "after_total_fees",
            "before_total_fees",
            "custom_before_total_fees",
            "request_id",
            "booking_status",
            "email_status",
            "payment_status",
            "welcome_email",
            "review_email",
            "reminder_email",
            "third_reminder_email",
            "checkin_email",
            "checkout_email",
            "name",
            "email",
            "mobile",
            "message",
            "ip_address",
            "cancel_reason",
            "note",
            'rental_aggrement_status',
            'rental_aggrement_signature',
            'rental_aggrement_images',
            'total_payment',
            'amount_data',
            'rental_agreement_link',
            'how_many_payment_done',
            'sent_date',
            'payment_date',
            'rental_agreement_ip',
            'sent_ip',

            
            'total_pets',
            'pet_fee',
            'guest_fee',
            'rest_guests',
            'single_guest_fee',
            'discount',
            'discount_coupon',
            'after_discount_total',
            'extra_discount',


            'accessories_rate_ids',
            'mileage_rate_ids',
            'option_rate_ids',
            'tax',
            'define_tax',
            'where_they_are',
            'rental_agreement_date',
            
            
            "customer_profile_id",
            "customer_profile_payment_id",
            "refund_tran_id",
            "customer_json_data",
            "void_status",
            "booking_type_admin",
            'status_data'
    ];
}
