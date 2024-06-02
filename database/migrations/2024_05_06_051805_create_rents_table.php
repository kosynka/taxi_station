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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_id')
                ->nullable()
                ->constrained('cars')
                ->nullOnDelete();

            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('contract_file_path')->nullable();
            $table->string('contract_with_buy_file_path')->nullable();
            $table->json('comments')->nullable();

            $table->boolean('is_paid')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
