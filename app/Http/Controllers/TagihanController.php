<?php

namespace App\Http\Controllers;

use App\Models\{Tagihan, Project, Rental};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;      // ← tambahkan
use Carbon\Carbon;

class TagihanController extends Controller
{
    /* =========================================================
       FORM INPUT TAGIHAN PER-PROJECT
       GET /project/{project}/tagihan
       ========================================================= */
    public function tagihanrental(Project $project)
    {
        // ------ muat data utama ------------------------------------------------
        $project->load('rentals');                    // pastikan relasi plural
        $data_project = Project::select('id', 'nama')->get();

        // ------ ambil semua tagihan yg terkait project ------------------------
        $data_tagihan = Tagihan::with('rental')
            ->whereHas('rental', fn ($q) =>
                $q->where('project_id', $project->id)
            )
            ->latest()
            ->get();

        // ------ metrik ringkas -----------------------------------------------
        $totalUnit  = $project->rentals->count();
        $grandTotal = $project->rentals->sum('total_tagihan');

        return view('components.inputtagihan', compact(
            'project', 'data_project', 'data_tagihan',
            'totalUnit', 'grandTotal'
        ));
    }

    /* =========================================================
       PROSES SIMPAN TAGIHAN  (POST / rental/{rental}/tagihan )
       ========================================================= */
   public function buattagihan(Request $request, Project $project)
{
    /* 1. VALIDASI */
    $validated = $request->validate([
        'durasi_tagih'    => 'required|string',
        'keterangan'      => 'nullable|string|max:255',
        'tanggal_tagihan' => 'required|date',
    ]);

    /* 2. AMBIL RENTAL & HITUNG */
    $rentals = $project->rentals;
    if ($rentals->isEmpty()) {
        return back()->with('error', 'Project ini belum memiliki rental.');
    }

    $jumlahUnit   = $rentals->count();
    $grandTotal   = $rentals->sum('total_tagihan');
    $nomorInvoice = (Tagihan::max('nomor_invoice') ?? 0) + 1;
    $rentalIdFK   = $rentals->first()->id;   // ← hanya satu tanda >

    /* 3. TRANSAKSI MANUAL */
    DB::beginTransaction();
    try {
        Tagihan::create([
            'rental_id'       => $rentalIdFK,
            'nomor_invoice'   => $nomorInvoice,
            'keterangan'      => $validated['keterangan'] ?? 'Tagihan otomatis',
            'tanggal_tagihan' => $validated['tanggal_tagihan'],
            'jumlah_unit'     => $jumlahUnit,
            'durasi_tagih'    => $validated['durasi_tagih'],
            'grand_total'     => $grandTotal,
        ]);                       // ] dan ) HARUS ada
                                  //  ↑  ↑

        DB::commit();
        return back()->with('success', 'Tagihan berhasil dibuat.');
    } catch (\Throwable $e) {
        DB::rollBack();
        // tampilkan pesan detail saat debugging
        return back()->with('error', $e->getMessage());
    }
}

    public function detailshow(Tagihan $tagihan)
{
    /* muat relasi sampai daftar rentals project */
    $tagihan->load('rental.project.rentals');

    $project  = $tagihan->rental->project ?? null;           // bisa null-safe
    $rentals  = $project ? $project->rentals : collect();    // ← buat koleksi

    $totalUnit  = $rentals->count();
    $grandTotal = $rentals->sum('total_tagihan');

    return view('components.tagihan', [
        'tagihan'     => $tagihan,
        'project'     => $project,
        'rentals'     => $rentals,     // 🔑 KIRIM ke Blade
        'totalUnit'   => $totalUnit,
        'grandTotal'  => $grandTotal,
    ]);
}



}
