<!-- resources/views/partials/status_form.blade.php -->
<div class="modal-header">
    <h5 class="modal-title">Update Status - {{ $item->nama }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('update.status', $item->id) }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Ruang Tes:</label>
            <select name="ruang_tes" class="form-select" required>
                <option value="">Pilih Ruang</option>
                @for ($i = 1; $i <= 15; $i++)
                    <option value="{{ $i }}" {{ $item->ruang_tes == $i ? 'selected' : '' }}>
                        Ruang {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Sesi Tes:</label>
            <select name="sesi_tes" class="form-select" required>
                <option value="">Pilih Sesi</option>
                @for ($i = 1; $i <= 3; $i++)
                    <option value="{{ $i }}" {{ $item->sesi_tes == $i ? 'selected' : '' }}>
                        Sesi {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label d-block mb-2">Status Berkas:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status_berkas" id="status0{{ $item->id }}"
                    value="0" {{ $item->status_berkas == 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="status0{{ $item->id }}">
                    Belum Menyerahkan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status_berkas" id="status1{{ $item->id }}"
                    value="1" {{ $item->status_berkas == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="status1{{ $item->id }}">
                    Sudah Menyerahkan
                </label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    </div>
</form>
