<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('account_number')->unique();
            $table->string('holder_name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('authorized_by')->nullable();
            $table->decimal('opening_balance');
            $table->decimal('current_balance');
            $table->string('status')->default('Active'); //   ['in-Active', 'Active',]

            $table->foreignId('parent_account_id')->nullable()->references('id')->on('accounts');
            $table->foreignId('account_id')->nullable()->references('id')->on('accounts');

            $table->foreignId('parent_expenses_account_id')->nullable()->references('id')->on('accounts');
            $table->foreignId('expenses_account_id')->nullable()->references('id')->on('accounts');

            $table->foreignId('currency_id')->nullable()->references('id')->on('currencies');
            $table->foreignId('creator_id')->nullable()->references('id')->on('users');

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
