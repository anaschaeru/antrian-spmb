<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Imports\AntrianImport;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

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
    const VALID_TOKEN = 'SPMB80';

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
            'ruang_tes' => 'nullable|string|min:1',
            'sesi_tes' => 'nullable|string|min:1',
            'status_berkas' => 'boolean'
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

    public function getBiodataForm($id)
    {
        $item = Antrian::findOrFail($id);
        return view('partials.biodata_form', compact('item'))->render();
    }

    public function getStatusForm($id)
    {
        $item = Antrian::findOrFail($id);
        return view('partials.status_form', compact('item'))->render();
    }


    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        Excel::import(new AntrianImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data antrian berhasil diimpor.');
    }

    public function datatable(Request $request)
    {
        $query = Antrian::query();

        return DataTables::of($query)
            ->addColumn('action', function ($antrian) {
                return '
                <button class="btn btn-warning btn-sm edit-btn"
                    data-id="' . $antrian->id . '"
                    data-modal-type="edit">
                    <span class="bi bi-pencil"></span>
                </button>
                <button class="btn btn-primary btn-sm update-btn"
                    data-id="' . $antrian->id . '"
                    data-modal-type="update">
                    Update Status
                </button>
            ';
            })
            ->editColumn('status_berkas', function ($antrian) {
                return $antrian->status_berkas
                    ? '<i class="bi bi-check-circle text-success fs-3"></i>'
                    : '<i class="bi bi-x-circle text-danger fs-3"></i>';
            })
            ->editColumn('ruang_tes', function ($antrian) {
                return 'Ruang: ' . ($antrian->ruang_tes ?? 'Belum ditentukan') . '<br>' .
                    'Sesi: ' . ($antrian->sesi_tes ?? 'Belum ditentukan');
            })
            ->rawColumns(['action', 'status_berkas', 'ruang_tes'])
            ->toJson();
    }

    public function getModal($id, $type)
    {
        $antrian = Antrian::findOrFail($id);

        if ($type === 'edit') {
            return view('modals.edit', compact('antrian'));
        } elseif ($type === 'update') {
            return view('modals.update', compact('antrian'));
        }

        abort(404);
    }

    public function edit($id)
    {
        $antrian = Antrian::findOrFail($id);
        return response()->json($antrian);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_formulir' => 'required|string|size:10|unique:antrian,nomor_formulir,' . $id,
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:100',
            'nomor_telpon' => 'required|string|min:10|max:13',
            'konsentrasi_1' => 'required|string|max:50',
        ]);

        $antrian = Antrian::findOrFail($id);
        $antrian->update($validated);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }
}
