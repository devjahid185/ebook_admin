<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone')->unique()->nullable();
        $table->string('profile_image')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->text('address')->nullable();
        $table->string('gender')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone','profile_image','date_of_birth','address','gender']);
    });
}
};
