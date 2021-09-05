<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posisi_id')->constrained('posisi')->onDelete('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->tinyText('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email');
            $table->string('foto');
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
        Schema::dropIfExists('pengurus');
    }
}
