<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
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
        return view('index', compact('antrians', 'totalAntrian'));
    }

    public function checkAndDownloadPdf(Request $request)
    {
        $request->validate([
            'nomor_formulir' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        // Cek data di database
        $antrian = Antrian::where('nomor_formulir', $request->nomor_formulir)
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$antrian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan. Pastikan nomor formulir dan tanggal lahir sudah benar.');
        }

        // Generate PDF
        $pdf = Pdf::loadView('pdf.antrian', compact('antrian'));

        return $pdf->download('Nomor_Antrian_' . $antrian->nomor_formulir . '.pdf');
    }

    public function tesMinatBakat()
    {
        $testMinatBakat = Antrian::whereNotNull('ruang_tes')
            ->whereNotNull('sesi_tes')
            ->where('status_berkas', true)
            ->get();

        return view('tes-minat-bakat', compact('testMinatBakat'));
    }
}
