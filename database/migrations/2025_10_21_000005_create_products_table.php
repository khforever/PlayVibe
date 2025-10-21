<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('sub_category_id')->constrained('sub_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
