<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('streak')->default(0)->after('password');
            $table->date('last_visit')->nullable()->after('streak');
            $table->json('weekly_visits')->nullable()->after('last_visit');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['streak', 'last_visit', 'weekly_visits']);
        });
    }
};