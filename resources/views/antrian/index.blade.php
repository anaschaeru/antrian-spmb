@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3>Selamat Datang di Sistem Antrian Pendaftaran Siswa Baru</h3>
                <p>Silakan isi formulir di bawah ini untuk mengambil nomor antrian.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach ([['bg' => 'primary', 'title' => 'Total Antrian', 'value' => $totalAntrian], ['bg' => 'success', 'title' => 'Sudah Menyerahkan', 'value' => $sudahMenyerahkan], ['bg' => 'danger', 'title' => 'Belum Menyerahkan', 'value' => $belumMenyerahkan]] as $card)
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card bg-{{ $card['bg'] }} text-white">
                    <div class="card-body">
                        <h3>{{ $card['title'] }}</h3>
                        <h2>{{ $card['value'] }}</h2>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="mt-2">Daftar Antrian</h2>
                    <div class="table-responsive">
                        <table id="example" class="table row-border" width="100%">
                            <thead>
                                <tr class="text-center align-middle">
                                    <th class="text-center">Antrian</th>
                                    <th class="text-start">Nama</th>
                                    <th class="text-center">Tanggal Pengumpulan Berkas</th>
                                    <th class="text-center">Konsentrasi Keahlian</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tes Minat Bakat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrians as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-secondary fw-bolder">
                                                {{ $item->nomor_antrian }}
                                            </button>
                                        </td>
                                        <td class="text-uppercase">
                                            {{ $item->nomor_formulir }}
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">
                                                <span class="bi bi-pencil"></span>
                                            </button>
                                            <br>{{ $item->nama }}<br>
                                            <span class="text-secondary">{{ $item->asal_sekolah }}</span>
                                        </td>
                                        <td class="text-center">{{ $item->tanggal_kumpul }}</td>
                                        <td class="text-center">{{ $item->konsentrasi_1 }}</td>
                                        <td>
                                            @if ($item->status_berkas)
                                                <i class="bi bi-check-circle text-success fs-3"></i>
                                            @else
                                                <i class="bi bi-x-circle text-danger fs-3"></i>
                                            @endif
                                        </td>
                                        <td>
                                            Ruang: {{ $item->ruang_tes ?? 'Belum ditentukan' }}<br>
                                            Sesi: {{ $item->sesi_tes ?? 'Belum ditentukan' }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $item->id }}">
                                                Update Status
                                            </button>
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

    <!-- Modals outside the table to prevent duplication in DOM -->
    @foreach ($antrians as $item)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Biodata Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update.biodata', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nomor Peserta:</label>
                                <input type="text" name="nomor_formulir" class="form-control"
                                    value="{{ $item->nomor_formulir }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama:</label>
                                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir:</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ $item->tanggal_lahir }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Asal Sekolah:</label>
                                <input type="text" name="asal_sekolah" class="form-control"
                                    value="{{ $item->asal_sekolah }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon:</label>
                                <input type="text" name="nomor_telpon" class="form-control"
                                    value="{{ $item->nomor_telpon }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Status Modal -->
        <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-pencil-square"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update.status', $item->id) }}" method="POST"
                        id="updateForm{{ $item->id }}">
                        @csrf
                        <div class="modal-body">
                            <!-- Ruang Tes (1-15) -->
                            <div class="mb-4">
                                <label class="form-label mb-2 d-block">Ruang Tes:</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @for ($i = 1; $i <= 15; $i++)
                                        <label
                                            class="btn btn-outline-primary m-1 @if (($item->ruang_tes ?? old('ruang_tes')) == $i) active @endif">
                                            <input type="radio" name="ruang_tes" value="{{ $i }}"
                                                @if (($item->ruang_tes ?? old('ruang_tes')) == $i) checked @endif required>
                                            {{ $i }}
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Sesi Tes (1-3) -->
                            <div class="mb-4">
                                <label class="form-label mb-2 d-block">Sesi Tes:</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <label
                                            class="btn btn-outline-primary m-1 @if (($item->sesi_tes ?? old('sesi_tes')) == $i) active @endif">
                                            <input type="radio" name="sesi_tes" value="{{ $i }}"
                                                @if (($item->sesi_tes ?? old('sesi_tes')) == $i) checked @endif required>
                                            {{ $i }}
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label d-block mb-2">Status Berkas:</label>
                                <!-- Belum Menyerahkan Option -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_berkas" id="status0"
                                        value="0"
                                        {{ ($item->status_berkas ?? old('status_berkas', 0)) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status0">
                                        Belum Menyerahkan
                                    </label>
                                </div>

                                <!-- Sudah Menyerahkan Option -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_berkas" id="status1"
                                        value="1"
                                        {{ ($item->status_berkas ?? old('status_berkas', 0)) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status1">
                                        Sudah Menyerahkan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="submit" class="btn btn-success me-2">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function validateToken(id) {
            // Your token validation logic here
            document.getElementById('updateForm' + id).submit();
        }
    </script>
@endsection
