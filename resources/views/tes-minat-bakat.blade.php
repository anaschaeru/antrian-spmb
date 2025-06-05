@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center my-5">
                <img width="80%" class="img-fluid p-4" src="{{ asset('images/logo-spmb-smkn4.png') }}" alt="">
                <h3 class="fw-bolder">SPMB SMKN 4 TANGERANG</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-center mb-4">
                <h4 class="fw-bolder">Jadwal Tes Minat Bakat</h4>
                <p>Silakan cek data tes minat bakat Anda di bawah ini.</p>
            </div>
            <table class="table table-striped table-bordered" id="tableMinatBakat">
                <thead class="table-dark">
                    <tr class="text-center align-middle">
                        <th>#</th>
                        <th>Pendaftar</th>
                        <th class="text-center">Konsentrasi Keahlian</th>
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
                            <td class="text-uppercase">{{ $item->nomor_formulir }}<br>{{ $item->nama }}<br><span
                                    class="text-secondary">{{ $item->asal_sekolah }}</span>
                            </td>
                            <td class="text-center">{{ $konsentrasiMapping[$item->konsentrasi_1] ?? 'Belum Memilih' }}</td>
                            <td>
                                Ruang: {{ $item->ruang_tes ?? 'Belum ditentukan' }}<br>
                                Sesi: {{ $item->sesi_tes ?? 'Belum ditentukan' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
