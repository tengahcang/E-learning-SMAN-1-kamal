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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->foreign('id_siswa')->references('id')->on('siswas');
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->foreign('id_guru')->references('id')->on('gurus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_siswa']);
            $table->dropForeign(['id_guru']);
            $table->dropColumn(['id_siswa', 'id_guru']);
        });
    }
};
