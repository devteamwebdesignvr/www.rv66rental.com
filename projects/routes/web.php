<?php
use Illuminate\Support\Facades\Route;


Route::get("rental/{id}","PageController@rental");


Route::get("fullcalendar/{id}",function(){return view("welcome");});
Route::get('/reload-captcha',  'PageController@reloadCaptcha');
Route::get("robots.txt",function(){return response(view('front.robots'), 200, ['Content-Type' => 'text/plain']);});
Route::get("fullcalendar-demo/{id}",function(){return view("welcome-demo");});
Route::post("fullcalendar-demo-post",function(){return view("common-dates");});
Route::post("get-quote-post","PageController@getQuotePost")->name("getQuotePost");
Route::get('/pay','PaymentController@pay')->name('pay');
Route::post('/dopay/online', 'PaymentController@handleonlinepay')->name('dopay.online');



Route::group(["namespace"=>"Payment","middleware"=>[]],function(){
   Route::get("auto-debit-amount-on-authroized-net","AuthorizeNetController@twoDayBeforePaymentData")->name("auto-debit-amount-on-authroized-net");
});
Route::group(["prefix"=>"admin","namespace"=>"Payment","middleware"=>["auth"]],function(){

    Route::get("booking-enquiries/{id}/release","AuthorizeNetController@releasePayment")->name("booking-enquiries.release");
    Route::get("booking-enquiries/{id}/charge","AuthorizeNetController@chargePayment")->name("booking-enquiries.charge");


});
Route::post("get-states-data","GauravCommonController@stateDateSelect")->name("stateDateSelect");
Route::group(["prefix"=>"admin","namespace"=>"Admin","middleware"=>["auth"]],function(){
    Route::get("/",'DashboardController@index');
    Route::post("get-checkin-checkout-data-gaurav","BookingRequestController@getCheckinCheckoutDataGaurav")->name("get-checkin-checkout-data-gaurav");
    Route::get("/media-center","DashboardController@mediaCenter");
    Route::post("/new-file-uploads","DashboardController@newFileUploads")->name("new-file-uploads");
    Route::get("change-password","DashboardController@changePassword")->name("admin-change-password");
    Route::post("change-password","DashboardController@changePasswordPost")->name("change-password-admin");
    Route::get("setting","DashboardController@setting");
    Route::post("setting","DashboardController@settingPost");
    Route::delete("medias-destroy","DashboardController@mediasDelete")->name("medias-destroy");
    Route::get('ckeditor', 'CkeditorController@index');
    Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
    Route::get("blog-category/copydata/{id}","BlogCategoryController@copyData")->name("blog-category.copyData");
    Route::get("blogs/copydata/{id}","BlogController@copyData")->name("blogs.copyData");
    Route::get("properties/copydata/{id}","PropertyController@copyData")->name("properties.copyData");
    Route::post("image-delete-asset","PropertyController@imageDeleteAsset")->name("image-delete-asset");
    Route::get("delete-property-space-single","PropertyController@deletePropertySpace")->name("delete-property-space-single");
    Route::get("sliders/copydata/{id}","SliderController@copyData")->name("sliders.copyData");
    Route::get("faqs/copydata/{id}","FaqController@copyData")->name("faqs.copyData");
    Route::get("galleries/copydata/{id}","GalleryController@copyData")->name("galleries.copyData");
    Route::get("testimonials/copydata/{id}","TestimonialController@copyData")->name("testimonials.copyData");
    Route::post("multiple-delete/{models}","DashboardController@multipleDelete")->name("multipleDelete");
    Route::get("galleries/active/{id}","GalleryController@active")->name("galleries.active");
    Route::get("galleries/deactive/{id}","GalleryController@deactive")->name("galleries.deactive");
    Route::get("blogs/active/{id}","BlogController@active")->name("blogs.active");
    Route::get("blogs/deactive/{id}","BlogController@deactive")->name("blogs.deactive");
    Route::get("properties/active/{id}","PropertyController@active")->name("properties.active");
    Route::get("properties/deactive/{id}","PropertyController@deactive")->name("properties.deactive");
    Route::get("properties/{property_id}/group-amenities","PropertyAmenityGroupController@index")->name("properties-group-amenities");
    Route::get("properties/{property_id}/group-amenities/create","PropertyAmenityGroupController@create")->name("properties-group-amenities.create");
    Route::post("properties/{property_id}/group-amenities/create","PropertyAmenityGroupController@store")->name("properties-group-amenities.store");
    Route::get("properties/{property_id}/group-amenities/{id}/edit","PropertyAmenityGroupController@edit")->name("properties-group-amenities.edit");
    Route::put("properties/{property_id}/group-amenities/{id}/update","PropertyAmenityGroupController@update")->name("properties-group-amenities.update");
    Route::get("properties/{property_id}/group-amenities/{id}/delete","PropertyAmenityGroupController@destroy")->name("properties-group-amenities.destroy");
    Route::get("properties/{property_id}/group-amenities/{id}/active","PropertyAmenityGroupController@active")->name("properties-group-amenities.active");
    Route::get("properties/{property_id}/group-amenities/{id}/deactive","PropertyAmenityGroupController@deactive")->name("properties-group-amenities.deactive");
    Route::get("properties/{property_id}/rooms","PropertyRoomController@index")->name("properties-group-rooms");
    Route::get("properties/{property_id}/rooms/create","PropertyRoomController@create")->name("properties-group-rooms.create");
    Route::post("properties/{property_id}/rooms/create","PropertyRoomController@store")->name("properties-group-rooms.store");
    Route::get("properties/{property_id}/rooms/{id}/edit","PropertyRoomController@edit")->name("properties-group-rooms.edit");
    Route::put("properties/{property_id}/rooms/{id}/update","PropertyRoomController@update")->name("properties-group-rooms.update");
    Route::delete("properties/{property_id}/rooms/{id}/delete","PropertyRoomController@destroy")->name("properties-group-rooms.destroy");
    Route::get("properties/{property_id}/rooms/{id}/active","PropertyRoomController@active")->name("properties-group-rooms.active");
    Route::get("properties/{property_id}/rooms/{id}/deactive","PropertyRoomController@deactive")->name("properties-group-rooms.deactive");
    Route::get("properties/{property_id}/group-amenities/{group_id}/amenities","PropertyAmenityController@index")->name("properties-amenities");
    Route::get("properties/{property_id}/group-amenities/{group_id}/amenities/create","PropertyAmenityController@create")->name("properties-amenities.create");
    Route::post("properties/{property_id}/group-amenities/{group_id}/amenities/store","PropertyAmenityController@store")->name("properties-amenities.store");
    Route::get("properties/{property_id}/group-amenities/{group_id}/amenities/{id}/edit","PropertyAmenityController@edit")->name("properties-amenities.edit");
    Route::put("properties/{property_id}/group-amenities/{group_id}/amenities/{id}/update","PropertyAmenityController@update")->name("properties-amenities.update");
    Route::delete("properties/{property_id}/group-amenities/{group_id}/amenities/{id}/delete","PropertyAmenityController@destroy")->name("properties-amenities.destroy");
    Route::get("properties/{property_id}/group-amenities/{group_id}/amenities/{id}/active","PropertyAmenityController@active")->name("properties-amenities.active");
    Route::get("properties/{property_id}/group-amenities/{group_id}/amenities/{id}/deactive","PropertyAmenityController@deactive")->name("properties-amenities.deactive");
    Route::get("properties/{property_id}/rooms/{group_id}/sub-room","PropertyRoomItemController@index")->name("properties-sub-room");
    Route::get("properties/{property_id}/rooms/{group_id}/sub-room/create","PropertyRoomItemController@create")->name("properties-sub-room.create");
    Route::post("properties/{property_id}/rooms/{group_id}/sub-room/store","PropertyRoomItemController@store")->name("properties-sub-room.store");
    Route::get("properties/{property_id}/rooms/{group_id}/sub-room/{id}/edit","PropertyRoomItemController@edit")->name("properties-sub-room.edit");
    Route::put("properties/{property_id}/rooms/{group_id}/sub-room/{id}/update","PropertyRoomItemController@update")->name("properties-sub-room.update");
    Route::delete("properties/{property_id}/rooms/{group_id}/sub-room/{id}/delete","PropertyRoomItemController@destroy")->name("properties-sub-room.destroy");
    Route::get("properties/{property_id}/rooms/{group_id}/sub-room/{id}/active","PropertyRoomItemController@active")->name("properties-sub-room.active");
    Route::get("properties/{property_id}/rooms/{group_id}/sub-room/{id}/deactive","PropertyRoomItemController@deactive")->name("properties-sub-room.deactive");
    Route::get('booking-enquiries/confirmed/{id}',"BookingRequestController@confirmed")->name("booking-enquiry-confirm");
  
    Route::get('booking-enquiries/admin-confirmed/{id}',"BookingRequestController@adminEmail")->name("booking-enquiries.admin-confirmed");
  
    Route::get("properties/{property_id}/rates","PropertyRateController@index")->name("properties-rates");
    Route::get("properties/{property_id}/rates/create","PropertyRateController@create")->name("properties-rates.create");
    Route::post("properties/{property_id}/rates/create","PropertyRateController@store")->name("properties-rates.store");
    Route::get("properties/{property_id}/rates/{id}/edit","PropertyRateController@edit")->name("properties-rates.edit");
    Route::put("properties/{property_id}/rates/{id}/update","PropertyRateController@update")->name("properties-rates.update");
    Route::delete("properties/{property_id}/rates/{id}/delete","PropertyRateController@destroy")->name("properties-rates.destroy");
    Route::post("properties/update-property-caption-and-sorting","PropertyController@updateCaptionSOrt")->name("update-property-caption-and-sorting");
    Route::get("properties/{property_id}/calendar","PropertyCalendarController@index")->name("properties-calendar.index");
    Route::get("properties/{property_id}/calendar/import-list","PropertyCalendarController@importlist")->name("properties-calendar.import-list");
    Route::get("properties/{property_id}/calendar/import-list-refresh/{id}","PropertyCalendarController@importlistRefresh")->name("properties-calendar.importlistRefresh");
    Route::get("properties/{property_id}/calendar/create","PropertyCalendarController@create")->name("properties-calendar.create");
    Route::post("properties/{property_id}/calendar/create","PropertyCalendarController@store")->name("properties-calendar.store");
    Route::delete("properties/{property_id}/calendar/{id}/delete","PropertyCalendarController@destroy")->name("properties-calendar.destroy");
    Route::get("properties/{property_id}/calendar/self-ical-refresh","PropertyCalendarController@selfIcalRefresh")->name("properties-calendar.selfIcalRefresh");



    Route::post("delete-millage-by-id","PropertyController@deleteMillage")->name("deleteMillage");
    Route::post("delete-option-by-id","PropertyController@deleteoption")->name("deleteoption");
    Route::post("delete-accessories-by-id","PropertyController@deleteaccessories")->name("deleteaccessories");
    
    
    Route::get("booking-enquiries/{id}/active","BookingRequestController@activePayment")->name("booking-enquiries.active");
    Route::get("booking-enquiries/{id}/deactive","BookingRequestController@deactivePayment")->name("booking-enquiries.deactive");
    Route::get("booking-enquiries/index-deactive","BookingRequestController@indexDeactive")->name("booking-enquiries.index-deactive");



     Route::resources([
        'users'=>UserController::class,
        'sliders' => SliderController::class,
        'cms'=>CmsController::class,
        'locations'=>LocationController::class,
        'attractions'=>AttractionController::class,
        'welcome_packages'=>WelcomePackageController::class,
        'coupons'=>CouponController::class,
        'email-templetes'=>EmailTempleteController::class,
        'faqs'=>FaqController::class,
        'check_in_configs'=> CheckinConfigController::class,
        'galleries'=>GalleryController::class,
        'newsletters'=>NewsLetterController::class,
        'our-clients'=>OurClientController::class,
        'testimonials'=>TestimonialController::class,
        'our-teams'=>OurTeamController::class,
        'blogs'=>BlogController::class,
        'blog-category'=>BlogCategoryController::class,
        'properties'=>PropertyController::class,
        'services'=>ServiceController::class,
        'contact-us-enquiries'=>ContactusRequestController::class,
        'booking-enquiries'=>BookingRequestController::class,
        'payments'=>PaymentController::class,
    ]);
});

Auth::routes();
Route::get("set-cron-job","ICalController@setCronJob");
Route::post("checkajax-get-quote","PageController@checkAjaxGetQuoteData")->name("checkajax-get-quote");
Route::post("admin-checkajax-get-quote","PageController@adminCheckAjaxGetQuoteData")->name("admin-checkajax-get-quote");
Route::put("admin-checkajax-get-quote-edit","PageController@adminCheckAjaxGetQuoteDataEdit")->name("admin-checkajax-get-quote-edit");
Route::get("send-reminder-email","ICalController@sendReminderPackage");
Route::get("refresh-calendar-data","ICalController@refresshCalendar")->name("refresshCalendar");
Route::get("set-pricelab","ICalController@setPriceLab")->name("setPriceLab");
Route::get("send-welcome-packages","ICalController@sendWelcomePackage")->name("sendWelcomePackage");
Route::get("send-review-email","ICalController@sendReviewEmail")->name("sendReviewEmail");
Route::get("ical/{id}","ICalController@getEventsICalObject");
Route::get("sitemap.xml","PageController@sitemap");
Route::post("contact-post","PageController@contactPost")->name("contactPost");
Route::post("review-submit","PageController@reviewSubmit")->name("reviewSubmit");
Route::post("newsletter-post","PageController@newsletterPost")->name("newsletterPost");
Route::post("save-booking-data","PageController@saveBookingData")->name("save-booking-data");
Route::post("rental-aggrement-data-save","PageController@rentalAggrementDataSave")->name("rental-aggrement-data-save");
Route::post("booking/payment/{id}","Payment\StripeController@indexPost")->name("stripe.post");
Route::get("booking/payment/paypal/post/{id}","Payment\PaypalController@indexPost")->name("paypal.submit");
Route::post("booking/payment/authorize/post/{id}","Payment\AuthorizeNetController@indexPost")->name("authorize.submit");
Route::post("booking/payment/instapay/post/{id}","Payment\InstapayController@indexPost")->name("instapay.submit");

Route::group(["middleware"=>["OptimizeMiddleware"]],function(){
    Route::get("payment/success/{id}","Payment\CommonController@showReceipt");
    Route::get("booking/payment/{id}","Payment\StripeController@index")->name("stripe_payment");
    Route::get("booking/payment/paypal/{id}","Payment\PaypalController@index")->name("paypal_payment");
    Route::get("booking/payment/authorize/{id}","Payment\AuthorizeNetController@index")->name("authorize_payment");
    Route::get("booking/payment/instapay/{id}","Payment\InstapayController@index")->name("instapay_payment");
    Route::get("booking/preview/{id}","PageController@previewBooking");
    Route::get("booking/rental-aggrement/{id}","PageController@rentalAggrementBooking");
    Route::get("properties/location/{seo_url}","PageController@propertyLocation");
    Route::get("attractions/detail/{seo_url}","PageController@attractionSingle");
    Route::get("attractions/location/{seo_url}","PageController@attractionLocation");
    Route::get("properties/detail/{seo_url}","PageController@propertyDetail");
    Route::get("blog/{seo_url}","PageController@blogSingle");
    Route::get("blogs/category/{seo_url}","PageController@categoryData");
    Route::get('/', "PageController@index")->name("front-home");
    Route::get("{seo_url}","PageController@dynamicDataCategory")->name("services");
});