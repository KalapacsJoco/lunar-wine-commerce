<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::table('lunar_product_variants')
            ->whereIn('id', [10, 11])
            ->update(['stock' => 100]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
