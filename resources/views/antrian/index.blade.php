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
                                <tr class="text-center align-middle">
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
                                            {{ $item->nomor_formulir }}
                                            <!-- Tombol untuk membuka modal -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">
                                                <span class="bi bi-pencil"></span>
                                            </button>

                                            <!-- Modal Bootstrap -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Biodata Siswa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('update.biodata', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <label class="text-warning mb-2">*) Masukan Nomor Peserta,
                                                                    sesuai yang tertera pada bukti
                                                                    cetak
                                                                    pendaftaran
                                                                    online dari <a
                                                                        href="https://spmb.bantenprov.go.id/">https://spmb.bantenprov.go.id</a>.
                                                                </label>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text"
                                                                        class="form-control @error('nomor_formulir') is-invalid @enderror"
                                                                        id="floatingInput" placeholder="Nomor Peserta"
                                                                        name="nomor_formulir" maxlength="10"
                                                                        inputmode="numeric" minlength="10"
                                                                        value="{{ old('nomor_formulir') }}" required>
                                                                    <label for="floatingInput">Nomor Peserta</label>
                                                                    @error('nomor_formulir')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text"
                                                                        class="form-control @error('nama') is-invalid @enderror text-uppercase"
                                                                        id="floatingInput" placeholder="Nama Lengkap"
                                                                        name="nama" minlength="1"
                                                                        value="{{ old('nama') }}" required>
                                                                    <label for="floatingInput">Nama Lengkap</label>
                                                                    @error('nama')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date"
                                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                                        id="floatingInput" placeholder="Tanggal Lahir"
                                                                        name="tanggal_lahir"
                                                                        value="{{ old('tanggal_lahir') }}" required>
                                                                    <label for="floatingInput">Tanggal Lahir</label>
                                                                    @error('tanggal_lahir')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text"
                                                                        class="form-control @error('asal_sekolah') is-invalid @enderror text-uppercase"
                                                                        id="floatingInput" placeholder="Asal Sekolah"
                                                                        name="asal_sekolah"
                                                                        value="{{ old('asal_sekolah') }}" maxlength="50"
                                                                        minlength="1" required>
                                                                    <label for="floatingInput">Asal Sekolah</label>
                                                                    @error('asal_sekolah')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text"
                                                                        class="form-control @error('nomor_telpon') is-invalid @enderror text-uppercase"
                                                                        id="floatingInput" placeholder="Nomor Telepon"
                                                                        name="nomor_telpon" inputmode="numeric"
                                                                        value="{{ old('nomor_telpon') }}" maxlength="13"
                                                                        minlength="12" required>
                                                                    @error('nomor_telpon')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    <label for="floatingInput">Nomor Telepon</label>
                                                                </div>
                                                                <label class="text-warning mb-2">*) Pililah Konsentrasi
                                                                    Keahlian 1
                                                                    sesuai dengan yang tertera pada bukti cetak pendaftaran
                                                                    online dari <a
                                                                        href="https://spmb.bantenprov.go.id/">https://spmb.bantenprov.go.id</a>.
                                                                </label>
                                                                <div class="mb-3">
                                                                    <label for="konsentrasi_1" class="mb-2">Pilihan
                                                                        Konsentrasi Keahlian Ke-1:</label>
                                                                    <select name="konsentrasi_1" class="form-select py-3"
                                                                        required>
                                                                        <option value="0" selected>Pilih Konsentrasi
                                                                            Keahlian</option>
                                                                        <option value="TP">Teknik Pemesinan</option>
                                                                        <option value="TMI">Teknik Mekanik Industri
                                                                        </option>
                                                                        <option value="DGM">Desain Gambar Mesin</option>
                                                                        <option value="TITL">Teknik Instalasi Tenaga
                                                                            Listrik</option>
                                                                        <option value="TOI">Teknik Otomasi Industri
                                                                        </option>
                                                                        <option value="DPIB">Desain Pemodelan dan
                                                                            Informasi Bangunan</option>
                                                                        <option value="TKP">Teknik Konstruksi dan
                                                                            Perumahan</option>
                                                                        <option value="TPG">Teknik Perawatan Gedung
                                                                        </option>
                                                                        <option value="GEO">Teknik Geomatika</option>
                                                                        <option value="RPL">Rekayasa Perangkat Lunak
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <label>Nomor Peserta:</label>
                                                                <input type="text" name="nomor_formulir"
                                                                    class="form-control"
                                                                    value="{{ $item->nomor_formulir }}" required>

                                                                <label>Nama:</label>
                                                                <input type="text" name="nama" class="form-control"
                                                                    value="{{ $item->nama }}" required>

                                                                <label>Tanggal Lahir:</label>
                                                                <input type="date" name="tanggal_lahir"
                                                                    class="form-control"
                                                                    value="{{ $item->tanggal_lahir }}" required>

                                                                <label>Asal Sekolah:</label>
                                                                <input type="text" name="asal_sekolah"
                                                                    class="form-control"
                                                                    value="{{ $item->asal_sekolah }}" required>

                                                                <label>Nomor Telepon:</label>
                                                                <input type="text" name="nomor_telpon"
                                                                    class="form-control"
                                                                    value="{{ $item->nomor_telpon }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Simpan
                                                                    Perubahan</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>{{ $item->nama }}<br><span
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
                                                            <h5 class="modal-title"><i class="bi bi-pencil-square"></i>
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
