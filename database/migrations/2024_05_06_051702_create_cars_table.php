<?php

declare(strict_types=1);

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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('state_number')->unique();
            $table->string('brand');
            $table->string('model');
            $table->unsignedInteger('year')->default(0);
            $table->enum('status', ['on_rent', 'in_parking', 'at_service', 'parking_fine'])->default('in_parking');
            $table->unsignedBigInteger('mileage')->default(0);
            $table->unsignedBigInteger('deposit')->default(0);
            $table->unsignedBigInteger('rent_sum')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
