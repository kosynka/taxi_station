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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rent_id')
                ->nullable()
                ->constrained('rents')
                ->nullOnDelete();

            $table->enum('type', ['fine', 'accident'])->default('fine');
            $table->string('protocol_file_path')->nullable();
            $table->datetime('received_at');
            $table->datetime('paid_at')->nullable();
            $table->unsignedBigInteger('amount');
            $table->enum('status', ['unpaid', 'paid_with_discount', 'paid_without_discount'])->default('unpaid');
            $table->json('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
