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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->date('opening_stock');
            $table->unsignedDecimal('selling_price', 10, 2);
            $table->unsignedDecimal('purchasing_price', 10, 2);

            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('warehouse_id')->references('id')->on('warehouses');
            $table->foreignId('creator_id')->references('id')->on('users');
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
        Schema::dropIfExists('stocks');
    }
};