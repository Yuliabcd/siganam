<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posisi;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posisi::insert([
            ['nama' => 'Ketua'],
            ['nama' => 'Sekretaris I'],
            ['nama' => 'Sekretaris II'],
            ['nama' => 'Bendahara'],
            ['nama' => 'Sie. Sosial'],
            ['nama' => 'Sie. Simpan Pinjam'],
            ['nama' => 'Sie. Arisan'],
            ['nama' => 'Posyandu'],
        ]);
    }
}
