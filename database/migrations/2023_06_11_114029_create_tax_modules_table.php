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
        Schema::create('tax_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->references('id')->on('modules');
            $table->foreignId('tax_id')->references('id')->on('taxes');

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
        Schema::dropIfExists('tax_modules');
    }
};
