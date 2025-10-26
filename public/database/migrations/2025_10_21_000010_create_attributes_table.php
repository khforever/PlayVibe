<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('sumthumb')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('dimension')->nullable();
            $table->string('maincompartment')->nullable();
            $table->string('durable_fabric')->nullable();
            $table->string('spacious')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('attributes');
    }
};
