<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('cart_items', function (Blueprint $table) {

       
        $table->foreignId('product_id')
            ->nullable()
            ->constrained('products')
            ->cascadeOnDelete();


        $table->foreignId('product_variant_id')
            ->nullable()
            ->change();
    });
}

public function down(): void
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->dropConstrainedForeignId('product_id');
        $table->foreignId('product_variant_id')->nullable(false)->change();
    });
}

};
