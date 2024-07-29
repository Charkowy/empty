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
        Schema::create('liquidations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('user_id')->constrained('users');
            $table->year('year');
            $table->unsignedTinyInteger('month');
            $table->mediumInteger('amount');
            $table->enum('send_notification', ['SI', 'NO'])->default('NO');
            $table->text('observations')->nullable();
            $table->text('account_bank_json')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['role_id', 'user_id', 'year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidations');
    }
};
