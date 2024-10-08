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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email',100)->nullable();
            $table->string('password',255);
            $table->string('phone',20)->nullable();
            $table->string('country_code',5)->nullable();
            $table->string('active')->default(true);
            $table->foreignId('type_id')->constrained('types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null')->onUpdate('set null');
            $table->foreignId('language_id')->constrained('languages')->onDelete('restrict')->onUpdate('restrict');
			$table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
