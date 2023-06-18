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
        Schema::create('revision_histories', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('revision_historyable_id');
            $table->string('revision_historyable_type');

            $table->unsignedBigInteger('edited_by');
            $table->foreign('edited_by')->references('id')->on('users');

            $table->text('old_data')->nullable();
            $table->text('new_data')->nullable();
            $table->string('reason')->nullable();

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
        Schema::dropIfExists('tax_modules');
    }
};
