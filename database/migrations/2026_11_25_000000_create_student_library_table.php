<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_library', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student')->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['student_id', 'book_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_library');
    }
};
