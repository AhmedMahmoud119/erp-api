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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('contact');
            $table->string('email');
            $table->foreignId('address_id')->references('id')->on('addresses');
            $table->foreignId('billing_address_id')->references('id')->on('addresses');
            $table->foreignId('currency_id')->references('id')->on('currencies');
            $table->foreignId('account_id')->references('id')->on('accounts');
            $table->foreignId('parent_account_id')->references('id')->on('accounts');
            $table->foreignId('creator_id')->nullable()
                ->references('id')->on('users');
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
        Schema::dropIfExists('customers');
    }
};
