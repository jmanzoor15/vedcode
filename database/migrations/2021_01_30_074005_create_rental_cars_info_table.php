<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalCarsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_cars_info', function (Blueprint $table) {
            $table->id();
            $table->string('car_company', 100)->collation = 'utf8_unicode_ci';
            $table->string('modal',50)->collation = 'utf8_unicode_ci';
            $table->string('owner_name',100)->collation = 'utf8_unicode_ci';
            $table->string('address',100)->collation = 'utf8_unicode_ci';
            $table->string('vehicle_number',50)->collation = 'utf8_unicode_ci';
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
        Schema::dropIfExists('rental_cars_info');
    }
}
