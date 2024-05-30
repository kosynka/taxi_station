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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->enum('role', [
                'admin',
                'seating_manager',
                'mechanic',
                'accountant',
                'investor',
                'manager',
                'taxi_driver',
            ])->default('taxi_driver');

            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('password');

            $table->bigInteger('balance')->nullable();

            $table->string('iin')->nullable()->unique();
            $table->string('id_doc_number')->nullable();
            $table->date('id_doc_date')->nullable();
            $table->date('id_doc_until_date')->nullable();
            $table->string('registration_address')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('driver_license_number')->nullable();
            $table->date('driver_license_date')->nullable();
            $table->string('driver_license_categories')->nullable();

            $table->json('comments')->nullable();
            $table->json('permissions')->nullable();

            $table->string('id_doc_photo_1')->nullable();
            $table->string('id_doc_photo_2')->nullable();
            $table->string('driver_license_photo_1')->nullable();
            $table->string('driver_license_photo_2')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
