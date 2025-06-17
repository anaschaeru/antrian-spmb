<!-- resources/views/partials/biodata_form.blade.php -->
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
            <input type="text" name="nomor_formulir" class="form-control" value="{{ $item->nomor_formulir }}"
                required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama:</label>
            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $item->tanggal_lahir }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Asal Sekolah:</label>
            <input type="text" name="asal_sekolah" class="form-control" value="{{ $item->asal_sekolah }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor Telepon:</label>
            <input type="text" name="nomor_telpon" class="form-control" value="{{ $item->nomor_telpon }}" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    </div>
</form>
