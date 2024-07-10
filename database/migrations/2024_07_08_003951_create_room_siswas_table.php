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
        Schema::create('room_siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_room');
            $table->unsignedBigInteger('id_siswa');
            $table->primary(['id_room', 'id_siswa']);
            $table->foreign('id_room')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_siswas');
    }
};
