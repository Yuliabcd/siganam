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
            ['nama' => 'Pembina'],
            ['nama' => 'Ketua'],
            ['nama' => 'Wakil Ketua'],
            ['nama' => 'Sekretaris'],
            ['nama' => 'Sekretaris I'],
            ['nama' => 'Sekretaris II'],
            ['nama' => 'Wakil Sekretaris'],
            ['nama' => 'Wakil Sekretaris I'],
            ['nama' => 'Wakil Sekretaris II'],
            ['nama' => 'Bendahara'],
            ['nama' => 'Wakil Bendahara'],
            ['nama' => 'Sie. Sosial'],
            ['nama' => 'Arisan'],
            ['nama' => 'Posyandu'],
        ]);
    }
}
