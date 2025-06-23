@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center my-5">
                <img width="50%" class="img-fluid p-4" src="{{ asset('images/logo-spmb-smkn4.png') }}" alt="">
                <h3 class="fw-bolder">SPMB SMKN 4 TANGERANG</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-4">
                <h3 class="fw-bolder text-center">Jadwal Tes Minat Bakat</h3>
                <p class="text-center">Silakan cek data tes minat bakat Anda di bawah ini.</p>
                <div class="card mb-4">
                    <div class="card-header header">
                        <h4 class="mb-0 py-2">Informasi Tes Minat Bakat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="row">

                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Tanggal:</strong></p>
                                        <p class="mb-0">Rabu, 25 Juni 2025</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Bertempat di:</strong></p>
                                        <p class="mb-0">SMKN 4 TANGERANG</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 session-card">
                                            <div class="card-body">
                                                <h6 class="card-title">Sesi 1</h6>
                                                <p class="card-text">08.00 WIB s.d. 09.00 WIB</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 session-card">
                                            <div class="card-body">
                                                <h6 class="card-title">Sesi 2</h6>
                                                <p class="card-text">09.30 WIB s.d. 10.30 WIB</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 session-card">
                                            <div class="card-body">
                                                <h6 class="card-title">Sesi 3</h6>
                                                <p class="card-text">11.00 WIB s.d. 12.00 WIB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h4 class="mb-0">Persyaratan Mengikuti Tes Minat Bakat</h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item requirement-item">
                                        <strong>Peserta terdaftar</strong> pada laman/situs SPMB Online Provinsi Banten →
                                        <a href="https://spmb.bantenprov.go.id"
                                            target="_blank">https://spmb.bantenprov.go.id</a>
                                    </li>
                                    <li class="list-group-item requirement-item">
                                        <strong>Membawa Cetak Bukti Pendaftaran</strong>, untuk ditunjukkan kepada Panitia
                                        SPMB.
                                    </li>
                                    <li class="list-group-item requirement-item">
                                        <strong>Menggunakan Seragam Sekolah Asal</strong>.
                                    </li>
                                    <li class="list-group-item requirement-item">
                                        <strong>Membawa Handphone</strong>, pastikan memiliki kuota internet.
                                    </li>
                                    <li class="list-group-item requirement-item">
                                        <strong>Membawa Alat Tulis</strong>, pulpen.
                                    </li>
                                    <li class="list-group-item requirement-item">
                                        <strong>Datang 15 menit sebelum</strong> pelaksanaan tes berlangsung.
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive-md">
                        <table id="tableMinatBakat" class="table table-striped">
                            <thead class="table-dark">
                                <tr class="text-center align-middle">
                                    <th>#</th>
                                    <th>Nama Pendaftar</th>
                                    <th>Asal Sekolah</th>
                                    <th class="text-center">Pilihan Konsentrasi ke- 1</th>
                                    <th>Tes Minat Bakat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $konsentrasiMapping = [
                                        'TP' => 'Teknik Pemesinan',
                                        'TMI' => 'Teknik Mekanik Industri',
                                        'DGM' => 'Desain Gambar Mesin',
                                        'TITL' => 'Teknik Instalasi Tenaga Listrik',
                                        'TOI' => 'Teknik Otomasi Industri',
                                        'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
                                        'TKP' => 'Teknik Konstruksi dan Perumahan',
                                        'TPG' => 'Teknik Perawatan Gedung',
                                        'TG' => 'Teknik Geomatika',
                                        'RPL' => 'Rekayasa Perangkat Lunak',
                                    ];
                                @endphp
                                @foreach ($testMinatBakat as $item)
                                    <tr class="align-middle ">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-uppercase">{{ $item->nomor_formulir }}<br>{{ $item->nama }}
                                        </td>
                                        <td class="text-start">{{ $item->asal_sekolah }}</td>
                                        <td class="text-center">
                                            {{ $konsentrasiMapping[$item->konsentrasi_1] ?? 'Belum Memilih' }}</td>
                                        <td>
                                            Ruang: {{ $item->ruang_tes ?? 'Belum ditentukan' }}
                                            Sesi: {{ $item->sesi_tes ?? 'Belum ditentukan' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
