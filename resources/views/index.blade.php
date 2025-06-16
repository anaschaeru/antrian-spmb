@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center my-5">
                <img class="img-fluid p-4" src="{{ asset('images/logo-spmb-smkn4.png') }}" alt="">
                <h3 class="fw-bolder">SPMB SMKN 4 TANGERANG</h3>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary w-100 py-4 mb-3 fs-1" data-bs-toggle="modal"
                data-bs-target="#modalAmbilAntrian"><i class="bi bi-ticket-perforated d-block"></i>
                Ambil Nomor Antrian
            </button>
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary w-100 py-4 mb-3 fs-1" data-bs-toggle="modal"
                data-bs-target="#modalAmbilAntrian" disabled><i class="bi bi-ticket-perforated d-block"></i>
                Ambil Nomor Antrian
            </button> --}}
            <!-- Modal -->
            <div class="modal fade" id="modalAmbilAntrian" tabindex="-1" aria-labelledby="modalAmbilAntrianLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalAmbilAntrianLabel">Form Antrian</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('antrian.store') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <label class="text-warning mb-2">*) Masukan Nomor Peserta, sesuai yang tertera pada bukti
                                    cetak
                                    pendaftaran
                                    online dari <a href="https://spmb.bantenprov.go.id/">https://spmb.bantenprov.go.id</a>.
                                </label>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nomor_formulir') is-invalid @enderror"
                                        id="floatingInput" placeholder="Nomor Peserta" name="nomor_formulir" maxlength="10"
                                        inputmode="numeric" minlength="10" value="{{ old('nomor_formulir') }}" required>
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
                                        id="floatingInput" placeholder="Nama Lengkap" name="nama" minlength="1"
                                        value="{{ old('nama') }}" required>
                                    <label for="floatingInput">Nama Lengkap</label>
                                    @error('nama')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="floatingInput" placeholder="Tanggal Lahir" name="tanggal_lahir"
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
                                        id="floatingInput" placeholder="Asal Sekolah" name="asal_sekolah"
                                        value="{{ old('asal_sekolah') }}" maxlength="50" minlength="1" required>
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
                                        id="floatingInput" placeholder="Nomor Telepon" name="nomor_telpon"
                                        inputmode="numeric" value="{{ old('nomor_telpon') }}" maxlength="13" minlength="12"
                                        required>
                                    @error('nomor_telpon')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="floatingInput">Nomor Telepon</label>
                                </div>
                                <label class="text-warning mb-2">*) Pililah Konsentrasi Keahlian 1
                                    sesuai dengan yang tertera pada bukti cetak pendaftaran online dari <a
                                        href="https://spmb.bantenprov.go.id/">https://spmb.bantenprov.go.id</a>.
                                </label>
                                <div class="mb-3">
                                    <label for="konsentrasi_1" class="mb-2">Pilihan Konsentrasi Keahlian Ke-1:</label>
                                    <select name="konsentrasi_1" class="form-select py-3" required>
                                        <option value="0" selected>Pilih Konsentrasi Keahlian</option>
                                        <option value="TP">Teknik Pemesinan</option>
                                        <option value="TMI">Teknik Mekanik Industri</option>
                                        <option value="DGM">Desain Gambar Mesin</option>
                                        <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                                        <option value="TOI">Teknik Otomasi Industri</option>
                                        <option value="DPIB">Desain Pemodelan dan Informasi Bangunan</option>
                                        <option value="TKP">Teknik Konstruksi dan Perumahan</option>
                                        <option value="TPG">Teknik Perawatan Gedung</option>
                                        <option value="GEO">Teknik Geomatika</option>
                                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Ambil Nomor Antrian</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-secondary w-100 py-4 mb-3 fs-1" data-bs-toggle="modal"
                data-bs-target="#modalCetakAntrian">
                <i class="bi bi-printer d-block"></i> Cetak Nomor Antrian
            </button>
            <!-- Modal Antrian -->
            <div class="modal fade" id="modalCetakAntrian" tabindex="-1" aria-labelledby="modalCetakAntrianLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalCetakAntrianLabel">Cetak Antrian</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/cetak-antrian" method="POST">
                            <div class="modal-body">
                                @csrf
                                <label class="text-warning mb-2">*) Masukan Nomor Peserta, sesuai yang tertera pada
                                    bukti
                                    cetak
                                    pendaftaran
                                    online dari <a href="https://spmb.bantenprov.go.id/">https://spmb.bantenprov.go.id</a>.
                                </label>
                                <div class="form-floating mb-3">
                                    <input type="text"
                                        class="form-control @error('nomor_formulir') is-invalid @enderror"
                                        id="floatingInput" placeholder="Nomor Peserta" name="nomor_formulir"
                                        maxlength="10" inputmode="numeric" minlength="10"
                                        value="{{ old('nomor_formulir') }}" required>
                                    <label for="floatingInput">Nomor Peserta</label>
                                    @error('nomor_formulir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="floatingInput" placeholder="Tanggal Lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir') }}" required>
                                    <label for="floatingInput">Tanggal Lahir</label>
                                    @error('tanggal_lahir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary w-100" type="submit"><i
                                        class="bi bi-printer d-block"></i>
                                    Cetak
                                    Antrian</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{ route('tes.minat.bakat') }}" class="btn btn-outline-success w-100 py-4 mb-3 fs-1">
                <i class="bi bi-calendar-event d-block"></i>Lihat Jadwal Tes Minat Bakat
            </a>
        </div>
    </div>
@endsection
