<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_variants', function (Blueprint $table){
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('color_id')->constrained('colors')->cascadeOnDelete();
            $table->foreignId('size_id')->constrained('sizes')->cascadeOnDelete();
            $table->unique(['product_id', 'color_id', 'size_id']);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('product_variants');
    }
};
