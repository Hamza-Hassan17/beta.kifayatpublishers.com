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
            $table->string('roll_number')->nullable()->change();
        });

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
