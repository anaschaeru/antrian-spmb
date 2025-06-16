<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AntrianController extends Controller
{

    const AVAILABLE_DATES = [
        '2025-06-17',
        '2025-06-18',
        '2025-06-19',
        '2025-06-20',
        '2025-06-23',
        '2025-06-24',
    ];

    const MAX_QUEUE_PER_DAY = 250;
    const VALID_TOKEN = '048025';

    public function index()
    {
        if (!session('token_valid')) {
            return view('antrian.token');
        }

        $antrians = Antrian::orderBy('nomor_antrian')->get();
        $totalAntrian = $antrians->count();

        $antrians->each(function ($antrian, $index) use ($totalAntrian) {
            $antrian->position = $index + 1;
            $antrian->total = $totalAntrian;
        });

        return view('antrian.index', [
            'antrians' => $antrians,
            'totalAntrian' => $totalAntrian,
            'sudahMenyerahkan' => Antrian::where('status_berkas', true)->count(),
            'belumMenyerahkan' => Antrian::where('status_berkas', false)->count()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_formulir' => 'required|unique:antrian|string|size:10',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:100',
            'nomor_telpon' => 'required|string|min:12|max:13',
            'konsentrasi_1' => 'nullable|string|max:50',
        ]);

        $tanggalKumpul = $this->getAvailableDate();
        if (!$tanggalKumpul) {
            return back()->with('error', 'Kuota penuh, pendaftaran ditutup.');
        }

        try {
            $nomorAntrian = Antrian::max('nomor_antrian') + 1;

            Antrian::create([
                ...$validated,
                'nomor_antrian' => $nomorAntrian,
                'tanggal_kumpul' => $tanggalKumpul,
            ]);

            return redirect('/')->with([
                'success_nomor' => $nomorAntrian,
                'success_tanggal' => Carbon::parse($tanggalKumpul)->translatedFormat('l, j F Y')
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')->withInput();
        }
    }

    public function updateBiodata(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_formulir' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required',
            'nomor_telpon' => 'required',
        ]);

        Antrian::findOrFail($id)->update($validated);

        return back()->with('success', 'Biodata siswa berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'ruang_tes' => 'required',
            'sesi_tes' => 'required',
            'status_berkas' => 'required|boolean'
        ]);

        Antrian::findOrFail($id)->update($validated);

        return back()->with('success_update', 'Data tes minat bakat berhasil diperbarui!');
    }

    public function validasiToken(Request $request)
    {
        if ($request->validate(['token' => 'required'])['token'] === self::VALID_TOKEN) {
            session(['token_valid' => true]);
            return redirect()->route('antrian')->with('success-login', 'Token valid!');
        }

        return back()->with('error', 'Token tidak valid, silakan coba lagi.');
    }

    public function logout()
    {
        session()->forget('token_valid');
        return redirect('/')->with('success', 'Anda telah logout.');
    }

    protected function getAvailableDate(): ?string
    {
        foreach (self::AVAILABLE_DATES as $date) {
            if (Antrian::where('tanggal_kumpul', $date)->count() < self::MAX_QUEUE_PER_DAY) {
                return $date;
            }
        }
        return null;
    }
}
