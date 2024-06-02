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
        Schema::table('rents', function (Blueprint $table) {
            if (!Schema::hasColumn('rents', 'is_paid')) {
                $table->boolean('is_paid')->default(false);
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'debt')) {
                $table->bigInteger('debt')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rents', function (Blueprint $table) {
            if (Schema::hasColumn('rents', 'is_paid')) {
                $table->dropColumn('is_paid');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'debt')) {
                $table->dropColumn('debt');
            }
        });
    }
};
