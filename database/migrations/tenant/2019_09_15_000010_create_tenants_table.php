<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            $table->string('status')->default('Disabled'); //   ['Disabled', 'Active', 'Suspended']
            $table->string('plan')->default('Free');    //  ['Free', 'Enterprise', 'Business', 'Starter', 'Premium']
            $table->string('industry_type')->nullable();     //  ['Schools', 'ERP System', 'Health', 'Retail']

            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');

            $table->unsignedBigInteger('assigned_id')->nullable();
            $table->foreign('assigned_id')->references('id')->on('users');

            $table->json('data')->nullable();
            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
