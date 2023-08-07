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
        Schema::create('journal_entry_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->float('debit')->default(0);
            $table->float('credit')->default(0);
            $table->foreignId('journal_entry_id')->constrained();
            $table->foreignId('tax_id')->nullable()->constrained();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('journal_entry_details');
    }
};
