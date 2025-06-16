<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AntrianController extends Controller
{
    //

    // tampilkan daftar antrian
    public function index()
    {
        $antrians = Antrian::orderBy('nomor_antrian')->get();

        // total antrian
        $totalAntrian = $antrians->count();
        if ($totalAntrian > 0) {
            $antrians->each(function ($antrian, $index) use ($totalAntrian) {
                $antrian->position = $index + 1;
                $antrian->total = $totalAntrian;
            });
        }

        $totalAntrian = Antrian::count();
        $sudahMenyerahkan = Antrian::where('status_berkas', true)->count();
        $belumMenyerahkan = Antrian::where('status_berkas', false)->count();
        return view('antrian.index', compact('antrians', 'totalAntrian', 'totalAntrian', 'sudahMenyerahkan', 'belumMenyerahkan'));
    }

    // simpan antrian baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_formulir' => 'required|unique:antrian|string|min:10|max:10',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:100',
            'nomor_telpon' => 'required|string|max:13|min:12',
            'konsentrasi_1' => 'nullable|string|max:50',
        ]);

        $tanggalTersedia = [
            Carbon::create(2025, 6, 17),
            Carbon::create(2025, 6, 18),
            Carbon::create(2025, 6, 19),
            Carbon::create(2025, 6, 20),
            Carbon::create(2025, 6, 23),
            Carbon::create(2025, 6, 24),
        ];

        $tanggalKumpul = null;

        foreach ($tanggalTersedia as $tanggal) {
            $jumlahAntrian = Antrian::where('tanggal_kumpul', $tanggal->format('Y-m-d'))->count();
            if ($jumlahAntrian < 300) {
                $tanggalKumpul = $tanggal;
                break;
            }
        }

        if (!$tanggalKumpul) {
            return redirect()->back()->with('error', 'Kuota penuh, pendaftaran ditutup.');
        }

        try {
            $nomorAntrian = Antrian::max('nomor_antrian') + 1;

            Antrian::create([
                'nomor_formulir' => $request->nomor_formulir,
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'asal_sekolah' => $request->asal_sekolah,
                'nomor_telpon' => $request->nomor_telpon,
                'nomor_antrian' => $nomorAntrian,
                'tanggal_kumpul' => $tanggalKumpul->format('Y-m-d'),
                'konsentrasi_1' => $request->input('konsentrasi_1', null),
            ]);

            return redirect('/')->with([
                'success_nomor' => $nomorAntrian,
                'success_tanggal' => $tanggalKumpul->translatedFormat('l, j F Y')
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'ruang_tes' => 'required',
            'sesi_tes' => 'required',
            'status_berkas' => 'required|boolean'
        ]);

        $antrian = Antrian::findOrFail($id);
        $antrian->update([
            'ruang_tes' => $request->ruang_tes,
            'sesi_tes' => $request->sesi_tes,
            'status_berkas' => $request->status_berkas
        ]);


        return redirect()->back()->with('success_update', 'Data tes minat bakat berhasil diperbarui!');
    }
}
