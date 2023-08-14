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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('contact');
            $table->string('email');
            $table->string('address_id');
            $table->foreignId('currency_id')->references('id')->on('currencies');
            $table->foreignId('parent_account_id')->references('id')->on('accounts');
            $table->foreignId('creator_id')->nullable()
                ->references('id')->on('users');
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
        Schema::dropIfExists('vendors');
    }
};
