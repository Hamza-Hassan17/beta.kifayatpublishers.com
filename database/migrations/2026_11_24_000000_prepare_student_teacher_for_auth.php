<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student', function (Blueprint $table) {
            $table->string('profile_img')->nullable();
            $table->rememberToken();
        });

        // Raw SQL because ->change() needs doctrine/dbal on Laravel 10 (MySQL syntax)
        DB::statement('ALTER TABLE student MODIFY roll_number VARCHAR(255) NULL');

        Schema::table('teacher', function (Blueprint $table) {
            $table->string('profile_img')->nullable();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropColumn(['profile_img', 'remember_token']);
        });

        Schema::table('teacher', function (Blueprint $table) {
            $table->dropColumn(['profile_img', 'remember_token']);
        });
    }
};
