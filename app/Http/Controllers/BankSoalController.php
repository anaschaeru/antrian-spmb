<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use Illuminate\Http\Request;

class BankSoalController extends Controller
{

    // 🔍 Tampilkan semua soal
    public function index()
    {
        if (!session('token_valid')) {
            return view('antrian.token');
        }

        $bank_soals = BankSoal::latest()->get();
        return view('bank_soal.index', compact('bank_soals'));
    }

    // ➕ Form tambah soal
    public function create()
    {
        return view('bank_soal.create');
    }

    // ✅ Simpan soal baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_konsentrasi_keahlian' => 'required|string',
            'nama_soal' => 'required|string',
            'link' => 'required|url',
            'sesi' => 'required|in:0,1,2,3',
        ]);

        BankSoal::create($request->all());

        return redirect()->route('bank-soal.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    // ✏️ Form edit soal
    public function edit($id)
    {
        $soal = BankSoal::findOrFail($id);
        return view('bank_soal.edit', compact('soal'));
    }

    // 🔄 Update soal
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_konsentrasi_keahlian' => 'required|string',
            'nama_soal' => 'required|string',
            'link' => 'required|url',
            'sesi' => 'required|in:0,1,2,3',
        ]);

        $soal = BankSoal::findOrFail($id);
        $soal->update($request->all());

        return redirect()->route('bank-soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    // 🗑 Hapus soal
    public function destroy($id)
    {
        BankSoal::findOrFail($id)->delete();
        return redirect()->route('bank-soal.index')->with('success', 'Soal berhasil dihapus.');
    }
}
