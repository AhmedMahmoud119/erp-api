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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact');

            $table->foreignId('account_id')->references('id')->on('accounts');
            $table->foreignId('parent_account_id')->references('id')->on('accounts');
//            $table->foreignId('address_id')->nullable()->references('id')->on('addresses')->onDelete('cascade');
            $table->foreignId('currency_id')->nullable()->references('id')->on('currencies');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
