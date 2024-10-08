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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
			$table->string('capitalized_name', 50)->unique();
			$table->string('iso', 2)->unique();
			$table->string('iso3', 3)->unique()->nullable();
			$table->string('num_code', 5)->unique()->nullable();
			$table->string('phone_code', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
