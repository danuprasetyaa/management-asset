<?php

// app/Http/Controllers/TagihanController.php
namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Tagihandetail;
use App\Models\Project;
use App\Models\Rental;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule; 

class TagihanController extends Controller
{
    
    public function tagihanrental(Project $project)
{
    // semua detail tagihan (tetap)
    $data_tagihan = Tagihandetail::with(['tagihan','rental'])
        ->whereHas('rental', fn($q) => $q->where('project_id', $project->id))
        ->latest('id')
        ->get();

    // ambil satu baris rental mana saja (mis. yang aktif) untuk ditampilkan ID-nya
    $rental = $project->rentals()->first();   // bisa null

    // hitung berapa banyak rental ( = jumlah asset_id) milik project ini
    $unit  = $project->rentals()->count();                // ← di-sini kuncinya
    $total = $unit * $project->harga_sewa;

    return view('components.inputtagihan', [
        'project'      => $project,
        'data_tagihan' => $data_tagihan,
        'rental'       => $rental,
        'unit'         => $unit,
        'total'        => $total,
    ]);
}
    public function buattagihan(Request $request)
{
    DB::listen(function ($q) {
    logger('[SQL]', [$q->sql, $q->bindings]);   // tulis ke storage/logs/laravel.log
});

    $validated = $request->validate([
            'project_id'      => ['required','exists:projects,id'],
            'rental_id'       => [
                'required',
                Rule::exists('rental','id')
                    ->where('project_id', $request->project_id),
            ],
            'nomor_invoice'   => 'required|integer|unique:tagihan,nomor_invoice',
            'keterangan'      => 'required|string|max:255',
            'tanggal_tagihan' => 'required|date',
            'periode_mulai'   => 'required|date',
            'periode_ahir'    => 'required|date|after_or_equal:periode_mulai',
        ]);

        /* ---------- 2. HITUNG UNIT & TOTAL ---------- */
        $project = Project::findOrFail($validated['project_id']);

        // jumlah baris rental = jumlah asset_id milik project
        $unit  = Rental::where('project_id', $project->id)->count();
        $total = $unit * $project->harga_sewa;


    try {
            DB::transaction(function () use ($validated, $unit, $total) {

                $tagihan = Tagihan::create([
                    'nomor_invoice'   => $validated['nomor_invoice'],
                    'keterangan'      => $validated['keterangan'],
                    'tanggal_tagihan' => $validated['tanggal_tagihan'],
                ]);

                $tagihan->details()->create([
                    'rental_id'     => $validated['rental_id'],
                    'periode_mulai' => $validated['periode_mulai'],
                    'periode_ahir'  => $validated['periode_ahir'],
                    'jumlah_unit'   => $unit,
                    'total_tagihan' => $total,
                ]);
            });

        return back()->with('success', 'Tagihan berhasil dibuat');
    } catch (\Throwable $e) {
        // tampilkan detail error sementara
        return back()->withErrors($e->getMessage());
    }

    
}
// TagihanController.php
public function detailshow(Tagihan $tagihan)      // implicit model binding
{

   $tagihan->load([
        'details.rental.asset',
        'details.rental.pengirimanDetail',
    ]);

    return view('components.tagihan', compact('tagihan'));
}


}


