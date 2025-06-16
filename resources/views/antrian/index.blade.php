@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3>Selamat Datang di Sistem Antrian Pendaftaran Siswa Baru</h3>
                <p>Silakan isi formulir di bawah ini untuk mengambil nomor antrian.</p>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>Total Antrian</h3>
                    <h2>{{ $totalAntrian }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>Sudah Menyerahkan</h3>
                    <h2>{{ $sudahMenyerahkan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h3>Belum Menyerahkan</h3>
                    <h2>{{ $belumMenyerahkan }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="mt-2">Daftar Antrian</h2>
                    <div class="table-responsive">
                        <table id="example" class="table row-border" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Antrian</th>
                                    <th class="text-start">Nama</th>
                                    {{-- <th>Tanggal Lahir</th> --}}
                                    <th class="text-center">Tanggal Pengumpulan Berkas</th>
                                    <th class="text-center">Konsentrasi Keahlian</th>
                                    {{-- <th>Nomor Telepon</th> --}}
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tes Minat Bakat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrians as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">
                                            <button type="button"
                                                class="btn btn-outline-secondary fw-bolder">{{ $item->nomor_antrian }}
                                            </button>
                                        </td>
                                        <td class="text-uppercase">
                                            {{ $item->nomor_formulir }}<br>{{ $item->nama }}<br><span
                                                class="text-secondary">{{ $item->asal_sekolah }}</span>
                                        </td>
                                        {{-- <td>{{ $item->tanggal_lahir }}</td> --}}
                                        <td class="text-center">{{ $item->tanggal_kumpul }}</td>
                                        <td class="text-center">{{ $item->konsentrasi_1 }}</td>
                                        {{-- <td>{{ $item->nomor_telpon }}</td> --}}
                                        <td> {!! $item->status_berkas
                                            ? '<i class="bi bi-check-circle text-success fs-3"></i>'
                                            : '<i class="bi bi-x-circle text-danger fs-3"></i>' !!}
                                        </td>
                                        <td>
                                            Ruang: {{ $item->ruang_tes ?? 'Belum ditentukan' }}<br>
                                            Sesi: {{ $item->sesi_tes ?? 'Belum ditentukan' }}
                                        </td>
                                        <td>
                                            <!-- Tombol untuk membuka modal -->
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $item->id }}">
                                                Update Status
                                            </button>

                                            <!-- Modal Bootstrap -->
                                            <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="updateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><i class="bi bi-pencil-square"></i></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('update.status', $item->id) }}"
                                                            method="POST" id="updateForm{{ $item->id }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <label>Ruang Tes:</label>
                                                                <input type="text" name="ruang_tes"
                                                                    class="form-control mb-2"
                                                                    placeholder="Masukkan Ruang Tes"
                                                                    value="{{ $item->ruang_tes ?? '-' }}" required>

                                                                <label>Sesi Tes:</label>
                                                                <input type="text" name="sesi_tes"
                                                                    class="form-control mb-2"
                                                                    placeholder="Masukkan Sesi Tes"
                                                                    value="{{ $item->sesi_tes ?? '-' }}" required>

                                                                <label>Status Berkas:</label>
                                                                <select name="status_berkas" class="form-control mb-2">
                                                                    <option value="0"
                                                                        {{ !$item->status_berkas ? 'selected' : '' }}>Belum
                                                                        Menyerahkan</option>
                                                                    <option value="1"
                                                                        {{ $item->status_berkas ? 'selected' : '' }}>Sudah
                                                                        Menyerahkan</option>
                                                                </select><label>Token Verifikasi:</label>
                                                                <input type="password" id="token{{ $item->id }}"
                                                                    class="form-control mb-2" placeholder="Masukkan Token"
                                                                    required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    onclick="validateToken({{ $item->id }})"
                                                                    class="btn btn-success">Simpan</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
