<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pengaturan::truncate();
        Pengaturan::create([
            'sesi' => 'sesi 1',
            'jam_mulai' => '09:00',
            'jam_selesai' => '09:15',
            'durasi_waktu' => '2'
        ]);
        Pengaturan::create([
            'sesi' => 'sesi 2',
            'jam_mulai' => '13:00',
            'jam_selesai' => '13:15',
            'durasi_waktu' => '2'
        ]);
        Pengaturan::create([
            'sesi' => 'sesi 3',
            'jam_mulai' => '15:00',
            'jam_selesai' => '15:15:00',
            'durasi_waktu' => '2'
        ]);
    }
}
