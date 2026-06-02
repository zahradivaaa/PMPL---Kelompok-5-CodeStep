<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('materi_id')
                ->constrained('materis')
                ->onDelete('cascade');

            $table->string('judul');

            $table->text('deskripsi')->nullable();

            $table->integer('durasi');

            $table->dateTime('tanggal_mulai');

            $table->dateTime('deadline');

            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};