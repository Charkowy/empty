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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('users');
            $table->unsignedInteger('relative_code');
            $table->string('sku')->unique();
            $table->string('name');
            $table->text('description');
            $table->unsignedMediumInteger('regular_price');
            $table->date('price_date');
            $table->date('entry_date');
            $table->enum('status', ['draft', 'pending', 'private', 'publish', 'refund']);
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['supplier_id', 'relative_code']);
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['product_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_category');
    }
};
