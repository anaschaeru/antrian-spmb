<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Antrian;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class AntrianImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            // Lewati baris jika nomor_formulir kosong
            if (empty($row[0])) {
                continue;
            }

            Antrian::updateOrCreate(
                ['nomor_formulir' => $row[0]],
                [
                    'nama'            => $row[1],
                    'tanggal_lahir'   => is_numeric($row[2]) ? Date::excelToDateTimeObject($row[2]) : Carbon::parse($row[2]),
                    'asal_sekolah'    => $row[3],
                    'nomor_telpon'    => $row[4],
                    'nomor_antrian'   => $row[5],
                    'tanggal_kumpul'  => is_numeric($row[6]) ? Date::excelToDateTimeObject($row[6]) : Carbon::parse($row[6]),
                    'ruang_tes'       => $row[7],
                    'sesi_tes'        => $row[8],
                    'status_berkas'   => $row[9],
                    'konsentrasi_1'   => $row[10],
                ]
            );
        }
    }
}
