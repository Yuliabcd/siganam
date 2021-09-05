<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanSimpanPinjamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_simpan_pinjam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('saldo_awal')->nullable();
            $table->unsignedBigInteger('tabungan')->nullable();
            $table->unsignedBigInteger('jasa')->nullable();
            $table->unsignedBigInteger('angsuran')->nullable();
            $table->unsignedBigInteger('denda')->nullable();
            $table->unsignedBigInteger('piutang')->nullable();
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
        Schema::dropIfExists('laporan_simpan_pinjam');
    }
}
