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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('date');
            $table->unsignedDecimal('quntity');
            $table->unsignedDecimal('total');
            $table->unsignedDecimal('discount');
            $table->foreignId('supplier_id')->references('suppliers')->on('id')->onDelete('cascade');
            $table->foreignId('stock_id')->references('stocks')->on('id')->onDelete('cascade');
            $table->foreignId('creator_id')->references('id')->on('users');
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
        Schema::dropIfExists('purchases');
    }
};
