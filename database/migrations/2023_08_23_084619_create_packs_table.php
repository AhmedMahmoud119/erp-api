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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('material');
            $table->integer('quantity');

            $table->unsignedDecimal('price', 16, 2);

            $table->unsignedDecimal('weight', 10, 2);
            $table->unsignedDecimal('width', 10, 2);
            $table->unsignedDecimal('length', 10, 2);
            $table->unsignedDecimal('height', 10, 2);

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
        Schema::dropIfExists('packs');
    }
};
