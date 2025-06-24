@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Logo Header -->
                <div class="text-center mb-5">
                    <img src="{{ asset('images/logo-spmb-smkn4.png') }}" alt="Logo SPMB SMKN 4" class="img-fluid"
                        style="max-height: 120px;" loading="lazy">
                    <h3 class="fw-bold mt-3">SPMB SMKN 4 TANGERANG</h3>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-3">
                    <!-- Hidden Queue Buttons -->
                    <button type="button" class="btn btn-primary btn-lg py-3 d-none" data-bs-toggle="modal"
                        data-bs-target="#modalAmbilAntrian">
                        <i class="bi bi-ticket-perforated me-2"></i> Ambil Antrian
                    </button>

                    <button type="button" class="btn btn-outline-secondary btn-lg py-3 d-none" data-bs-toggle="modal"
                        data-bs-target="#modalCetakAntrian">
                        <i class="bi bi-printer me-2"></i> Cetak Antrian
                    </button>

                    <!-- Test Button -->
                    <button class="btn btn-primary btn-lg py-3" data-bs-toggle="modal" data-bs-target="#modalLoginTes">
                        <i class="bi bi-mortarboard me-2"></i> Tes Minat & Bakat
                    </button>

                    <!-- Schedule Button -->
                    <a href="{{ route('tes.minat.bakat') }}" class="btn btn-outline-success btn-lg py-3">
                        <i class="bi bi-calendar-check me-2"></i> Jadwal Tes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Test Login Modal -->
    <div class="modal fade" id="modalLoginTes" tabindex="-1" aria-labelledby="modalLoginTesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalLoginTesLabel">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login Tes Minat & Bakat
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('tes-minat.cek') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-file-text me-1"></i> Nomor Formulir / N I S N
                            </label>
                            <input type="text" name="nomor_formulir" class="form-control"
                                placeholder="Masukkan nomor formulir" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-calendar-event me-1"></i> Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Cek Soal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Queue Modal -->
    <div class="modal fade" id="modalAmbilAntrian" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-ticket-perforated me-2"></i> Form Antrian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('antrian.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                Masukkan Nomor Peserta dari <a href="https://spmb.bantenprov.go.id/"
                                    target="_blank">spmb.bantenprov.go.id</a>
                            </div>
                        </div>

                        @include('partials.form-field', [
                            'type' => 'text',
                            'name' => 'nomor_formulir',
                            'label' => '<i class="bi bi-123 me-1"></i> Nomor Peserta',
                            'attributes' => 'maxlength="10" inputmode="numeric" minlength="10"',
                        ])

                        @include('partials.form-field', [
                            'type' => 'text',
                            'name' => 'nama',
                            'label' => '<i class="bi bi-person me-1"></i> Nama Lengkap',
                            'class' => 'text-uppercase',
                        ])

                        @include('partials.form-field', [
                            'type' => 'date',
                            'name' => 'tanggal_lahir',
                            'label' => '<i class="bi bi-calendar me-1"></i> Tanggal Lahir',
                        ])

                        @include('partials.form-field', [
                            'type' => 'text',
                            'name' => 'asal_sekolah',
                            'label' => '<i class="bi bi-building me-1"></i> Asal Sekolah',
                            'class' => 'text-uppercase',
                            'attributes' => 'maxlength="50" minlength="1"',
                        ])

                        @include('partials.form-field', [
                            'type' => 'text',
                            'name' => 'nomor_telpon',
                            'label' => '<i class="bi bi-telephone me-1"></i> Nomor Telepon',
                            'class' => 'text-uppercase',
                            'attributes' => 'inputmode="numeric" maxlength="13" minlength="12"',
                        ])

                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>Pilih Konsentrasi Keahlian 1 sesuai bukti pendaftaran</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-bookmark me-1"></i> Konsentrasi Keahlian
                            </label>
                            <select name="konsentrasi_1" class="form-select" required>
                                <option value="" selected disabled>Pilih Konsentrasi</option>
                                <option value="TP">Teknik Pemesinan</option>
                                <option value="TMI">Teknik Mekanik Industri</option>
                                <option value="DGM">Desain Gambar Mesin</option>
                                <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                                <option value="TOI">Teknik Otomasi Industri</option>
                                <option value="DPIB">Desain Pemodelan Bangunan</option>
                                <option value="TKP">Teknik Konstruksi Perumahan</option>
                                <option value="TPG">Teknik Perawatan Gedung</option>
                                <option value="GEO">Teknik Geomatika</option>
                                <option value="RPL">Rekayasa Perangkat Lunak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x me-1"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Print Queue Modal -->
    <div class="modal fade" id="modalCetakAntrian" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-printer me-2"></i> Cetak Antrian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="/cetak-antrian" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                Masukkan Nomor Peserta dari <a href="https://spmb.bantenprov.go.id/"
                                    target="_blank">spmb.bantenprov.go.id</a>
                            </div>
                        </div>

                        @include('partials.form-field', [
                            'type' => 'text',
                            'name' => 'nomor_formulir',
                            'label' => '<i class="bi bi-123 me-1"></i> Nomor Peserta',
                            'attributes' => 'maxlength="10" inputmode="numeric" minlength="10"',
                        ])

                        @include('partials.form-field', [
                            'type' => 'date',
                            'name' => 'tanggal_lahir',
                            'label' => '<i class="bi bi-calendar me-1"></i> Tanggal Lahir',
                        ])
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-printer me-1"></i> Cetak Antrian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-lg {
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .modal-header {
            border-radius: 0;
        }

        .form-control,
        .form-select {
            padding: 0.5rem 1rem;
        }

        .alert a {
            text-decoration: underline;
            font-weight: 500;
        }
    </style>
@endsection
