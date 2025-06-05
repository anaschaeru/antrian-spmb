<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Antrian extends Model
{
    //
    use HasFactory;

    protected $table = 'antrian';

    protected $fillable = [
        'nomor_formulir',
        'nama',
        'tanggal_lahir',
        'asal_sekolah',
        'nomor_telpon',
        'nomor_antrian',
        'tanggal_kumpul',
        'ruang_tes',
        'sesi_tes',
        'status_berkas',
        'konsentrasi_1',
    ];
}
