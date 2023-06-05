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
        Schema::create('currencies', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('symbol')->nullable();
            $table->string('price_rate');
            $table->decimal('price', 8, 2);
            $table->string('backup_changes')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('default')->default('0'); // 0   , 1
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
        Schema::dropIfExists('currencies');
    }
};
