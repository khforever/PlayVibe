<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        // $table->unsignedBigInteger('user_id');
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        // Shopping Information
        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->string('address');
        $table->string('city');

        // Delivery
        $table->integer('delivery_option')->default(1); // 1: Standard, 2: Eco, 3: Same Day
        $table->decimal('delivery_price', 10, 2)->default(0);

        // Notes
        $table->text('notes')->nullable();

        // Payment Method
        $table->integer('payment_method')->default(1); // 1: Cash on Delivery

        // Location (Map)
        $table->decimal('location_lat', 10, 7)->nullable();
        $table->decimal('location_lng', 10, 7)->nullable();

        // Prices
        $table->decimal('subtotal', 10, 2);


        // Status
        $table->integer('status')->default(1); // 1: Pending, 2: Cancelled, 3: delivered
        //is_archived
        $table->boolean('is_archived')->default(0);

        $table->timestamps();

        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    public function down(): void {
        Schema::dropIfExists('orders');
        Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('is_archived');
    });

    }
};
