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
            $table->string('vin')->nullable()->unique();
            $table->string('carcass')->nullable();
            $table->string('brand');
            $table->string('model');
            $table->double('engine_capacity')->nullable();
            $table->unsignedInteger('year')->default(2000);
            $table->string('color')->nullable();
            $table->unsignedBigInteger('mileage')->default(0);

            $table->unsignedBigInteger('amount')->default(0);
            $table->enum('status', ['on_rent', 'in_parking', 'at_service', 'parking_fine'])->default('in_parking');

            $table->string('photo_1')->nullable();
            $table->string('photo_2')->nullable();
            $table->string('photo_3')->nullable();
            $table->string('photo_4')->nullable();
            $table->string('photo_5')->nullable();
            $table->string('photo_6')->nullable();
            $table->string('photo_7')->nullable();
            $table->string('photo_8')->nullable();
            $table->string('photo_9')->nullable();
            $table->string('photo_10')->nullable();

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
