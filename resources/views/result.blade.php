@extends('layouts.app')

@section('content')
    <div class="container py-3">
        @if ($soal)
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-check fs-4 me-2"></i>
                        <div>
                            <h6 class="mb-0 text-capitalize">Selamat datang, <br>{{ $peserta->nama }}</h6>
                            <small class="opacity-75">{{ $peserta->asal_sekolah }}</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center border p-2 rounded">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-mortarboard text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Konsentrasi Keahlian</small>
                                    <strong class="d-block">{{ $soal->kode_konsentrasi_keahlian }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center border p-2 rounded">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-journal-text text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Nama Soal</small>
                                    <strong class="d-block">{{ $soal->nama_soal }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info d-flex align-items-center p-2 mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <div>
                            <small class="d-block">Sesi Aktif</small>
                            <strong>Sesi {{ $sesiAktif }}</strong>
                        </div>
                    </div>

                    <div class="d-grid">
                        <a href="{{ $soal->link }}" class="btn btn-primary btn-lg py-2">
                            <i class="bi bi-play-fill me-2"></i> Mulai Tes Sekarang
                        </a>
                    </div>
                </div>

                <div class="card-footer bg-light py-2 px-3 text-center">
                    <small class="text-muted">
                        <i class="bi bi-exclamation-triangle me-1"></i> Pastikan koneksi internet stabil sebelum memulai
                    </small>
                </div>
            </div>
        @else
            <div class="alert alert-warning d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                <div>
                    <h6 class="mb-1">Tidak Ada Soal Tersedia</h6>
                    <p class="mb-0">Belum ada soal yang disiapkan untuk sesi {{ $sesiAktif }}.</p>
                </div>
            </div>
        @endif
    </div>

    <style>
        .card {
            border-radius: 0.5rem;
        }

        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        .border {
            border-color: #dee2e6 !important;
        }
    </style>
@endsection
