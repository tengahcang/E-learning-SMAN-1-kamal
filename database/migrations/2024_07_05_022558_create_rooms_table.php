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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_matpel');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_guru');
            $table->text('description')->nullable();
            $table->foreign('id_matpel')->references('id')->on('mata_pelajarans');
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->foreign('id_guru')->references('id')->on('gurus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
