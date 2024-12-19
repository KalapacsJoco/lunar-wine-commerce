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
        // Lunar suppliers table
        Schema::table('lunar_suppliers', function (Blueprint $table) {
            $table->string('tax_id')->nullable()->after('address'); // Adószám
            $table->string('company_name')->nullable()->after('name'); // Cég neve
            $table->string('region')->nullable()->after('address'); // Régió
            $table->string('website')->nullable()->after('region'); // Weboldal
            $table->integer('total_orders')->default(0)->after('website'); // Összes rendelés
            $table->integer('total_products')->default(0)->after('total_orders'); // Összes termék
            $table->decimal('total_revenue', 15, 2)->default(0.00)->after('total_products'); // Összes bevétel
            $table->timestamp('last_order_date')->nullable()->after('total_revenue');
        });

        // Add supplier_id to lunar_products table
        Schema::table('lunar_products', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()
                  ->constrained('lunar_suppliers')
                  ->nullOnDelete(); // Link to suppliers table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove supplier_id column from lunar_products
        Schema::table('lunar_products', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropColumn('supplier_id');
        });

        // Drop lunar_suppliers table
        Schema::dropIfExists('lunar_suppliers');
    }};
