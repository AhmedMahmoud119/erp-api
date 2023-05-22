<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->renameColumn('custom_price','price');
        });
    }
    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->renameColumn('price','custom_price');
        });
    }
};
