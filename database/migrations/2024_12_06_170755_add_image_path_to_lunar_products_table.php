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
        Schema::table('lunar_products', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('attribute_data');
        });
    }
    
    public function down()
    {
        Schema::table('lunar_products', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
    
};
