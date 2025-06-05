<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AntrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanggalTersedia = [
            Carbon::create(2025, 6, 17),
            Carbon::create(2025, 6, 18),
            Carbon::create(2025, 6, 19),
            Carbon::create(2025, 6, 20),
            Carbon::create(2025, 6, 23),
            Carbon::create(2025, 6, 24),
            Carbon::create(2025, 6, 25),
        ];

        $konsentrasiOptions = ['TP', 'TMI', 'DGM', 'TITL', 'TOI', 'DPIB', 'TKP', 'TPG', 'TG', 'RPL'];
        $jumlahPerTanggal = array_fill(0, count($tanggalTersedia), 0);

        for ($i = 1; $i <= 2000; $i++) {
            $tanggalIndex = array_search(min($jumlahPerTanggal), $jumlahPerTanggal);

            if ($jumlahPerTanggal[$tanggalIndex] >= 250) {
                continue; // Lewati jika sudah penuh
            }

            $tanggalKumpul = $tanggalTersedia[$tanggalIndex];
            $jumlahPerTanggal[$tanggalIndex]++;

            DB::table('antrian')->insert([
                'nomor_formulir' => Str::random(8),
                'nama' => 'Siswa ' . $i,
                'tanggal_lahir' => Carbon::now()->subYears(rand(15, 18))->format('Y-m-d'),
                'asal_sekolah' => 'Sekolah ' . rand(1, 50),
                'nomor_telpon' => '08' . rand(1000000000, 9999999999),
                'nomor_antrian' => $i,
                'tanggal_kumpul' => $tanggalKumpul->format('Y-m-d'),
                'konsentrasi_1' => $konsentrasiOptions[array_rand($konsentrasiOptions)], // Pilih secara acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
