@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center my-5">
                <img class="img-fluid p-4" src="{{ asset('images/logo-spmb-smkn4.png') }}" alt="Logo SPMB SMKN 4"
                    loading="lazy">
                <h3 class="fw-bolder">SPMB SMKN 4 TANGERANG</h3>
            </div>

            <!-- Main Action Buttons -->
            <div class="d-grid gap-3">
                <!-- Take Queue Button -->
                <button type="button" class="btn btn-primary py-3 fs-1 d-none" data-bs-toggle="modal"
                    data-bs-target="#modalAmbilAntrian">
                    <i class="bi bi-ticket-perforated d-block"></i> Ambil Nomor Antrian
                </button>

                <!-- Print Queue Button -->
                <button type="button" class="btn btn-outline-secondary py-3 fs-1 d-none" data-bs-toggle="modal"
                    data-bs-target="#modalCetakAntrian">
                    <i class="bi bi-printer d-block "></i> Cetak Nomor Antrian
                </button>

                <!-- Test Schedule Button -->
                <a href="{{ route('tes.minat.bakat') }}" class="btn btn-outline-success py-3 fs-1">
                    <i class="bi bi-calendar-event d-block"></i> Lihat Jadwal Tes Minat Bakat
                </a>
            </div>

            <!-- Take Queue Modal -->
            <div class="modal fade" id="modalAmbilAntrian" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Form Antrian</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('antrian.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="alert alert-warning mb-3">
                                    Masukan Nomor Peserta, sesuai yang tertera pada bukti cetak pendaftaran online dari
                                    <a href="https://spmb.bantenprov.go.id/" target="_blank">spmb.bantenprov.go.id</a>.
                                </div>

                                @include('partials.form-field', [
                                    'type' => 'text',
                                    'name' => 'nomor_formulir',
                                    'label' => 'Nomor Peserta',
                                    'attributes' => 'maxlength="10" inputmode="numeric" minlength="10"',
                                ])

                                @include('partials.form-field', [
                                    'type' => 'text',
                                    'name' => 'nama',
                                    'label' => 'Nama Lengkap',
                                    'class' => 'text-uppercase',
                                ])

                                @include('partials.form-field', [
                                    'type' => 'date',
                                    'name' => 'tanggal_lahir',
                                    'label' => 'Tanggal Lahir',
                                ])

                                @include('partials.form-field', [
                                    'type' => 'text',
                                    'name' => 'asal_sekolah',
                                    'label' => 'Asal Sekolah',
                                    'class' => 'text-uppercase',
                                    'attributes' => 'maxlength="50" minlength="1"',
                                ])

                                @include('partials.form-field', [
                                    'type' => 'text',
                                    'name' => 'nomor_telpon',
                                    'label' => 'Nomor Telepon',
                                    'class' => 'text-uppercase',
                                    'attributes' => 'inputmode="numeric" maxlength="13" minlength="12"',
                                ])

                                <div class="alert alert-warning mb-3">
                                    Pilih Konsentrasi Keahlian 1 sesuai dengan yang tertera pada bukti cetak pendaftaran
                                    online.
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2">Pilihan Konsentrasi Keahlian Ke-1:</label>
                                    <select name="konsentrasi_1" class="form-select py-3" required>
                                        <option value="" selected disabled>Pilih Konsentrasi Keahlian</option>
                                        <option value="TP" {{ old('konsentrasi_1') == 'TP' ? 'selected' : '' }}>Teknik
                                            Pemesinan</option>
                                        <option value="TMI" {{ old('konsentrasi_1') == 'TMI' ? 'selected' : '' }}>Teknik
                                            Mekanik Industri</option>
                                        <option value="DGM" {{ old('konsentrasi_1') == 'DGM' ? 'selected' : '' }}>Desain
                                            Gambar Mesin</option>
                                        <option value="TITL" {{ old('konsentrasi_1') == 'TITL' ? 'selected' : '' }}>Teknik
                                            Instalasi Tenaga Listrik</option>
                                        <option value="TOI" {{ old('konsentrasi_1') == 'TOI' ? 'selected' : '' }}>Teknik
                                            Otomasi Industri</option>
                                        <option value="DPIB" {{ old('konsentrasi_1') == 'DPIB' ? 'selected' : '' }}>Desain
                                            Pemodelan dan Informasi Bangunan</option>
                                        <option value="TKP" {{ old('konsentrasi_1') == 'TKP' ? 'selected' : '' }}>Teknik
                                            Konstruksi dan Perumahan</option>
                                        <option value="TPG" {{ old('konsentrasi_1') == 'TPG' ? 'selected' : '' }}>Teknik
                                            Perawatan Gedung</option>
                                        <option value="GEO" {{ old('konsentrasi_1') == 'GEO' ? 'selected' : '' }}>Teknik
                                            Geomatika</option>
                                        <option value="RPL" {{ old('konsentrasi_1') == 'RPL' ? 'selected' : '' }}>
                                            Rekayasa Perangkat Lunak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ambil Nomor Antrian</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Print Queue Modal -->
            <div class="modal fade" id="modalCetakAntrian" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Cetak Antrian</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/cetak-antrian" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="alert alert-warning mb-3">
                                    Masukan Nomor Peserta, sesuai yang tertera pada bukti cetak pendaftaran online dari
                                    <a href="https://spmb.bantenprov.go.id/" target="_blank">spmb.bantenprov.go.id</a>.
                                </div>

                                @include('partials.form-field', [
                                    'type' => 'text',
                                    'name' => 'nomor_formulir',
                                    'label' => 'Nomor Peserta',
                                    'attributes' => 'maxlength="10" inputmode="numeric" minlength="10"',
                                ])

                                @include('partials.form-field', [
                                    'type' => 'date',
                                    'name' => 'tanggal_lahir',
                                    'label' => 'Tanggal Lahir',
                                ])
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-printer"></i> Cetak Antrian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
