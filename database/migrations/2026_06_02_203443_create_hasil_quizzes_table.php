<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('hasil_quizzes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->integer('nilai')->default(0);
        $table->integer('jumlah_benar')->default(0);
        $table->integer('jumlah_salah')->default(0);
        $table->integer('durasi_menit')->nullable();
        $table->timestamp('waktu_mulai')->nullable();
        $table->timestamp('waktu_selesai')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('hasil_quizzes');
}
};
