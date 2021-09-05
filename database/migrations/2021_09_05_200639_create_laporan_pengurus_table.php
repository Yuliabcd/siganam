<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pengurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pengurus_id')->constrained('pengurus')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('saldo_awal')->nullable();
            $table->unsignedBigInteger('masuk')->nullable();
            $table->unsignedBigInteger('keluar')->nullable();
            $table->unsignedBigInteger('saldo_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_pengurus');
    }
}
