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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained(
                table: 'menu_items',
                indexName: 'menu_items_parent_id'
            );
            $table->foreignId('permission_id')->nullable()->constrained('permissions');
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->unsignedSmallInteger('position');
            $table->string('text', 250)->nullable();
            $table->string('icon', 250)->nullable();
            $table->string('icon_color', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
