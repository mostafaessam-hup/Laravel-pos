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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100)->nullable();
            $table->string('email', 150)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('country_code', 5);
            $table->string('phone', 20)->unique();
            $table->string('password', 255)->nullable();
            $table->boolean('is_smoking')->nullable();
            $table->boolean('active')->default(true);
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->datetime('birthday')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('fcm_token')->nullable();
            $table->foreignId('language_id')->constrained('languages')->nullable()->onDelete('restrict')->onUpdate('restrict');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
