<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public $fillable=[
        "name",

            "seo_url",
            "heading",
            "price",
            "address",
            'property_status',
            'location_id',
            "mobile",
            "email",
            "website",
            "short_description",
            "long_description",
            "description",

            "cancellation_policy",
            "booking_policy",
            "notes",

            "bedroom",
            "bathroom",
            "beds",
            "sleeps",
            "area",
            "full_bath",
            "half_bath",
            "spaces",
            "feature_image",
            "banner_image",
            "cleaning_fee",
            "heating_swimming_pool_fee",
            "refundable_damage_fee",
            "pet_fee",
            "tax",
            "propane_gas",

            'checkin',
            'checkout',
            'category',
            'bed_type',
            'property_view',


            "status",
            "meta_title",
            "meta_keywords",
            "meta_description",
            "header_section",
            "footer_section",


            'tags',
            'is_home',
            'is_trending',
            'is_top',
            'is_feature',
            'is_bestseller',
            'is_sale',
            'is_hot',
            'min_stay',
            'standard_rate',
            'checkin_day',
            'checkout_day',
            'map',


            'welcome_package_description',
            'welcome_package_attachment',
            'rental_aggrement_attachment',
            'instant_booking_button',
            'api_id',
            'api_pms',
            'extra_bed',
            'queen_beds',
            'king_beds',
            
            'max_pet',
            'pet_fee',
            'pet_fee_interval',
            'guest_fee',
            'no_of_guest',

    ];
}
