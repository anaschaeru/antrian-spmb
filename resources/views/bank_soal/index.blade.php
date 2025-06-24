@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">
                <i class="bi bi-journal-bookmark"></i> Bank Soal
            </h4>
            <a href="{{ route('bank-soal.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-2 px-3" style="width: 20%">
                                <i class="bi bi-code-slash me-1"></i> Kode
                            </th>
                            <th class="py-2 px-3" style="width: 30%">
                                <i class="bi bi-journal-text me-1"></i> Nama Soal
                            </th>
                            <th class="py-2 px-3" style="width: 15%">
                                <i class="bi bi-link-45deg me-1"></i> Link
                            </th>
                            <th class="py-2 px-3" style="width: 15%">
                                <i class="bi bi-clock me-1"></i> Sesi
                            </th>
                            <th class="py-2 px-3 text-end" style="width: 20%">
                                <i class="bi bi-gear me-1"></i> Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bank_soals as $soal)
                            <tr>
                                <td class="py-2 px-3 small">{{ $soal->kode_konsentrasi_keahlian }}</td>
                                <td class="py-2 px-3">{{ $soal->nama_soal }}</td>
                                <td class="py-2 px-3">
                                    <a href="{{ $soal->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                </td>
                                <td class="py-2 px-3">
                                    @if ($soal->sesi == 0)
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-x-circle me-1"></i>Nonaktif
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>Sesi {{ $soal->sesi }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-2 px-3 text-end">
                                    <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $soal->id }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="{{ route('bank-soal.destroy', $soal->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus soal ini?')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($bank_soals as $soal)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal-{{ $soal->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 px-3">
                        <h6 class="modal-title mb-0">
                            <i class="bi bi-pencil me-1"></i>Edit Soal
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('bank-soal.update', $soal->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body py-3 px-3">
                            <div class="mb-3">
                                <label class="form-label small mb-1">
                                    <i class="bi bi-code-slash me-1"></i>Kode Konsentrasi
                                </label>
                                <input type="text" name="kode_konsentrasi_keahlian" class="form-control form-control-sm"
                                    value="{{ $soal->kode_konsentrasi_keahlian }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-1">
                                    <i class="bi bi-journal-text me-1"></i>Nama Soal
                                </label>
                                <input type="text" name="nama_soal" class="form-control form-control-sm"
                                    value="{{ $soal->nama_soal }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-1">
                                    <i class="bi bi-link-45deg me-1"></i>Link
                                </label>
                                <input type="url" name="link" class="form-control form-control-sm"
                                    value="{{ $soal->link }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-1">
                                    <i class="bi bi-clock me-1"></i>Sesi
                                </label>
                                <select name="sesi" class="form-select form-select-sm" required>
                                    <option value="0" {{ $soal->sesi == 0 ? 'selected' : '' }}>
                                        <i class="bi bi-x-circle"></i> Tidak Aktif
                                    </option>
                                    <option value="1" {{ $soal->sesi == 1 ? 'selected' : '' }}>Sesi 1</option>
                                    <option value="2" {{ $soal->sesi == 2 ? 'selected' : '' }}>Sesi 2</option>
                                    <option value="3" {{ $soal->sesi == 3 ? 'selected' : '' }}>Sesi 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer py-2 px-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg me-1"></i>Batal
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="bi bi-save me-1"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
