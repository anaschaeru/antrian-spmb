@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h4 class="mb-0">
                    <i class="bi bi-journal-text me-2"></i>
                    {{ isset($soal) ? 'Edit Soal' : 'Tambah Soal Baru' }}
                </h4>
            </div>

            <div class="card-body">
                <form action="{{ isset($soal) ? route('bank-soal.update', $soal->id) : route('bank-soal.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($soal))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label small text-muted mb-1">
                            <i class="bi bi-code-slash me-1"></i> Kode Konsentrasi
                        </label>
                        <input type="text" name="kode_konsentrasi_keahlian" class="form-control form-control-sm"
                            value="{{ old('kode_konsentrasi_keahlian', $soal->kode_konsentrasi_keahlian ?? '') }}"
                            placeholder="Masukkan kode konsentrasi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted mb-1">
                            <i class="bi bi-journal-bookmark me-1"></i> Nama Soal
                        </label>
                        <input type="text" name="nama_soal" class="form-control form-control-sm"
                            value="{{ old('nama_soal', $soal->nama_soal ?? '') }}" placeholder="Masukkan nama soal"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted mb-1">
                            <i class="bi bi-link-45deg me-1"></i> Link Soal
                        </label>
                        <input type="url" name="link" class="form-control form-control-sm"
                            value="{{ old('link', $soal->link ?? '') }}" placeholder="https://contoh.link/soal" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted mb-1">
                            <i class="bi bi-clock me-1"></i> Sesi
                        </label>
                        <select name="sesi" class="form-select form-select-sm" required>
                            <option value="0">-- Pilih Sesi --</option>
                            <option value="1" {{ old('sesi', $soal->sesi ?? '') == 1 ? 'selected' : '' }}>
                                Sesi 1
                            </option>
                            <option value="2" {{ old('sesi', $soal->sesi ?? '') == 2 ? 'selected' : '' }}>
                                Sesi 2
                            </option>
                            <option value="3" {{ old('sesi', $soal->sesi ?? '') == 3 ? 'selected' : '' }}>
                                Sesi 3
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bank-soal.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-save me-1"></i> {{ isset($soal) ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
