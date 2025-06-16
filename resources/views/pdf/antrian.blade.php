<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tiket Antrian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        p {
            margin: 2px;
            padding: 2px;
        }

        h1 {
            margin-bottom: 6px;
        }

        .mb-2 {
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .ticket {
            border: 2px solid #000;
            width: 100%;
            margin: center;
        }

        .info {
            font-size: 14px;
        }

        .info-nomor {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h1>NOMOR ANTRIAN</h1>
        <p><strong>SPMB SMKN 4 TANGERANG</strong></p>
        <p class="info">Nomor: </p>
        <p class="info-nomor"><strong>{{ $antrian->nomor_antrian }}</strong></p>
        <p class="info">Nama: </p>
        <p class="info-nomor"><strong>{{ strtoupper($antrian->nama) }}</strong>
        </p>
        {{-- <p class="info">Tanggal Lahir:
            <br>{{ \Carbon\Carbon::parse($antrian->tanggal_lahir)->translatedFormat('d F Y') }}
        </p> --}}
        <p class="info">Asal Sekolah: <br>{{ strtoupper($antrian->asal_sekolah) }}</p>
        <p class="info">Tanggal Pengumpulan Berkas:
            <br><strong>{{ \Carbon\Carbon::parse($antrian->tanggal_kumpul)->translatedFormat('l, d F Y') }}</strong>
        </p>
        <p class="info">Nomor Telepon: <br>{{ $antrian->nomor_telpon }}</p>
        <p class="info">Tanggal Cetak Antrian:
            <br><i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}</i>
        </p>
        <br>
    </div>
    <br>
    <br>
    <hr>
    <br>
    <br>

    <div style="text-align: left">
        <h2>BERKAS PERSYARATAN<br>SPMB SMKN 4 TANGERANG</h2>
        <p>Silakan siapkan berkas persyaratan berikut untuk pengumpulan berkas pada tanggal
            <strong>{{ \Carbon\Carbon::parse($antrian->tanggal_kumpul)->translatedFormat('l, d F Y') }}</strong>
            pukul 08.00 WIB s.d. 14.00 WIB
        </p>
        <div>
            <input type="checkbox"><label> Bukti Cetak Formulir Pendaftaran Online yang didapat dari
                website
                https://spmb.bantenprov.go.id/ </label><br>
        </div>
        <div>
            <input type="checkbox"><label> Bukti Cetak Nomor Antrian </label><br>
        </div>
        <div>
            <input type="checkbox"><label> Fotokopi Ijazah / SKL (Legalisir)</label><br>
        </div>
        <div>
            <input type="checkbox"><label> Fotokopi Nilai Raport 1 s.d. 5 (Legalisir)</label><br>
        </div>
        <div>
            <input type="checkbox"><label> Fotokopi Sertifikat/Piagam Prestasi (Jika ada)</label><br>
        </div>
        <div>
            <input type="checkbox"><label> Fotokopi Akta Kelahiran</label><br>
        </div>
        <div>
            <input type="checkbox"><label> Fotokopi Kartu Keluarga</label><br>
        </div>
        <div>
            <input type="checkbox"><label> Pas Foto Berwarna 3x4 (2 Lembar, latar belakang
                merah)</label><br>
        </div>
        <div>
            <input type="checkbox"><label> Surat Keterangan Sehat, yang menerangkan Sehat Jasmani Rohani,
                Tinggi badan min.
                laki-laki 157 cm,
                perempuan 150 cm, dan Tidak Buta Warna (dibuktikan dengan surat keterangan
                sehat khusus dari Puskesmas/Rumah Sakit)</label><br>
        </div>
    </div>
</body>

</html>
