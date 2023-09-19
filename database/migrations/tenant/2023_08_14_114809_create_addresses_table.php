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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('zip_code');

            $table->foreignId('state_id')->references('id')->on('states')->nullable();
            $table->foreignId('city_id')->references('id')->on('cities')->nullable();
            $table->foreignId('country_id')->references('id')->on('countries')->nullable();
            $table->softDeletes();

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
        Schema::dropIfExists('addresses');
    }
};
