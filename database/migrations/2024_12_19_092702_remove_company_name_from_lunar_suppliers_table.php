<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lunar_suppliers', function (Blueprint $table) {
            $table->dropColumn('company_name'); // Az oszlop eltávolítása
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('lunar_suppliers', function (Blueprint $table) {
            $table->string('company_name')->nullable(); // Az oszlop visszaállítása
        });
    }
};
