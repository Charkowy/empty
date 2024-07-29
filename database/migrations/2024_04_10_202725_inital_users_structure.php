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

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('name');
            $table->unsignedBigInteger('doc_number')->unique()->after('last_name');
            $table->string('google_id')->after('remember_token')->nullable();
            $table->string('facebook_id')->after('remember_token')->nullable();
            $table->renameColumn('name', 'first_name');
            $table->softDeletes();
        });

        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->date('birthday')->nullable();
            $table->string('phone', 250)->nullable();
            $table->string('state', 250)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('street', 250)->nullable();
            $table->string('zip', 250)->nullable();
            $table->string('instagram', 250)->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('supplier_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->foreignId('bank_id')->constrained('banks');
            $table->string('cbu', 250)->nullable();
            $table->string('alias', 250)->nullable();
            $table->string('account_owner', 250)->nullable();
            $table->string('account_number', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->renameColumn('first_name', 'name');
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('user_details');
        Schema::dropIfExists('supplier_details');
    }
};
