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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name', 150);
            $table->text('description');
            $table->integer('quantity');
            $table->unsignedInteger('opening_stock');
            $table->unsignedDecimal('selling_price', 10, 2);
            $table->unsignedDecimal('purchase_price', 10, 2);

            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('taxes_id')->references('id')->on('taxes');
            $table->foreignId('unit_id')->references('id')->on('unit_types');
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
        Schema::dropIfExists('products');
    }
};
