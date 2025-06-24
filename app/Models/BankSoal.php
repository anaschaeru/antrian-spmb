<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_konsentrasi_keahlian',
        'nama_soal',
        'link',
        'sesi',
    ];
}
