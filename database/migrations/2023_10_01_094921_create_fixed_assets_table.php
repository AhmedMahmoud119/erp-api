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
        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('description')->nullable();
            $table->date('acquisition_date');
            $table->integer('acquisition_value');
            $table->decimal('depreciation_ratio', 10, 2);
            $table->integer('depreciation_value');
            $table->integer('depreciation_duration_value');
            $table->integer('depreciation');
            $table->enum('depreciation_duration_type', ['month', 'year']);
            $table->unsignedBigInteger('parent_id');
            $table->string('parent_type');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('fixed_assets');
    }
};
