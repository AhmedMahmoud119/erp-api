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
        Schema::create('financial_periods', function (Blueprint $table) {
            $table->id();
            $table->string('financial_Year');
            $table->boolean('status');
            $table->date('financial_Year_Start');
            $table->date('financial_Year_End');

            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');

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
        Schema::dropIfExists('financial_periods');
    }
};
