<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_millage_rates', function (Blueprint $table) {
            $table->id();
            $table->string("property_id");
            $table->string("milleage_name",1025);
            $table->string("milleage_rate",1025);
            $table->string("milleage_status",50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_millage_rates');
    }
};
