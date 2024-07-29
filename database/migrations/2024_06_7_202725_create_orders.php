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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('billing_email');
            $table->enum('status', ['pending', 'processing', 'on-hold', 'completed', 'cancelled', 'refunded', 'failed', 'trash']);
            $table->string('discount_total');
            $table->string('shipping_total');
            $table->unsignedMediumInteger('total');
            $table->dateTime('date_created');
            $table->dateTime('date_modified');
            $table->dateTime('date_completed');
            $table->dateTime('date_paid');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->timestamps();
            $table->unique(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }
};
