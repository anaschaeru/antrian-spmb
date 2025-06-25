@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Sistem Antrian Pendaftaran</h4>
                <p class="mb-2 text-muted small">Isi formulir untuk mengambil nomor antrian</p>
                <form action="{{ route('antrian.import') }}" method="POST" enctype="multipart/form-data" class="row g-2">
                    @csrf
                    <div class="col-auto">
                        <input type="file" name="file" class="form-control form-control-sm" accept=".xlsx, .xls"
                            required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary">Import</button>
                    </div>
                </form>
            </div>
            <div class="btn-group">
                <a href="{{ route('bank-soal.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-book"></i> Bank Soal
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            </div>
        </div>

        <div class="row g-3 mb-4">
            @foreach ([['primary', 'Total Antrian', $totalAntrian], ['success', 'Sudah Menyerahkan', $sudahMenyerahkan], ['danger', 'Belum Menyerahkan', $belumMenyerahkan]] as $card)
                <div class="col-md-4">
                    <div class="card bg-{{ $card[0] }} text-white p-3">
                        <h6 class="card-title small">{{ $card[1] }}</h6>
                        <h4 class="mb-0">{{ $card[2] }}</h4>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-body p-3">
                <h5 class="card-title mb-3">Daftar Antrian</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="antrian-table">
                        <thead class="small">
                            <tr>
                                <th width="5%">Antrian</th>
                                <th>Nama</th>
                                <th width="12%">Tanggal</th>
                                <th width="15%">Jurusan</th>
                                <th width="8%">Status</th>
                                <th width="15%">Tes</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($antrians as $item)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $item->nomor_antrian }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">{{ $item->nomor_formulir }}</span>
                                            <button class="btn btn-xs btn-outline-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>
                                        <div class="text-uppercase small">{{ $item->nama }}</div>
                                        <div class="text-muted small">{{ $item->asal_sekolah }}</div>
                                    </td>
                                    <td>{{ $item->tanggal_kumpul }}</td>
                                    <td>{{ $item->konsentrasi_1 }}</td>
                                    <td class="text-center">
                                        <i
                                            class="bi {{ $item->status_berkas ? 'bi-check-circle text-success' : 'bi-x-circle text-danger' }}"></i>
                                    </td>
                                    <td class="small">
                                        Ruang: {{ $item->ruang_tes ?? '-' }}<br>
                                        Sesi: {{ $item->sesi_tes ?? '-' }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $item->id }}">
                                            Update
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @foreach ($antrians as $item)
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('update.biodata', $item->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h6 class="modal-title">Edit Biodata</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @foreach ([['nomor_formulir', 'Nomor Peserta', $item->nomor_formulir], ['nama', 'Nama', $item->nama], ['tanggal_lahir', 'Tanggal Lahir', $item->tanggal_lahir], ['asal_sekolah', 'Asal Sekolah', $item->asal_sekolah], ['nomor_telpon', 'Nomor Telepon', $item->nomor_telpon]] as $field)
                                    <div class="mb-2">
                                        <label class="form-label small">{{ $field[1] }}</label>
                                        <input type="{{ $field[0] === 'tanggal_lahir' ? 'date' : 'text' }}"
                                            name="{{ $field[0] }}" class="form-control form-control-sm"
                                            value="{{ $field[2] }}" required>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Status Modal -->
            <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('update.status', $item->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h6 class="modal-title">Update Status</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <h6 class="text-center mb-3">{{ $item->nama }}</h6>

                                <div class="mb-3">
                                    <label class="form-label small">Ruang Tes:</label>
                                    <select name="ruang_tes" class="form-select form-select-sm">
                                        <option value="">- Pilih -</option>
                                        @for ($i = 1; $i <= 15; $i++)
                                            <option value="{{ $i }}"
                                                {{ $item->ruang_tes == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small">Sesi Tes:</label>
                                    <select name="sesi_tes" class="form-select form-select-sm">
                                        <option value="">- Pilih -</option>
                                        @for ($i = 1; $i <= 3; $i++)
                                            <option value="{{ $i }}"
                                                {{ $item->sesi_tes == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small">Status Berkas:</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_berkas"
                                                id="status0{{ $item->id }}" value="0"
                                                {{ !$item->status_berkas ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="status0{{ $item->id }}">Belum</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_berkas"
                                                id="status1{{ $item->id }}" value="1"
                                                {{ $item->status_berkas ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="status1{{ $item->id }}">Sudah</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function() {
            $('#antrian-table').DataTable({
                pageLength: 25,
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
