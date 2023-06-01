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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('account_number')->unique();
            $table->string('holder_name');
            $table->string('account_type')->nullable();
            $table->string('chart_of_account')->nullable();
            $table->json('authorized_by')->nullable();
            $table->decimal('opening_balance');
            $table->decimal('current_balance');
            $table->string('status')->default('Active'); //   ['InActive', 'Active',]
            $table->foreignId('currency_id')->references('id')->on('currencies')->nullable();
            $table->foreignId('creator_id')->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
};
