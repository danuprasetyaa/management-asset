<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengiriman;
use App\Models\DetailAsset;   
use App\Models\Rental;             
use App\Models\Asset;
use App\Models\Project;
use Carbon\Carbon;

class PengirimanController extends Controller
{
    public function pengiriman($projectId)
    {
        $project       = Project::with('rentals')->findOrFail($projectId);
         // Ambil semua pengiriman yang terkait melalui rental
        $pengiriman = Pengiriman::with(['detailAsset.asset', 'rental'])
            ->whereHas('rental', fn($q) => $q->where('project_id', $projectId))
            ->latest()->get();

        

        $availableUnits = DetailAsset::whereDoesntHave('pengiriman')->get();

        return view('components.pengiriman', compact('project', 'pengiriman', 'availableUnits'));
    }

    public function kirim(Request $request)
    {
           $request->validate([
            'project_id'         => 'required|exists:projects,id',
            'detailasset_id'     => 'required|exists:detailasset,id',
            'tanggal_pengiriman' => 'required|date',
            'pic_pengirim'       => 'required|string|max:255',
            'pic_penerima'       => 'required|string|max:255',
        ]);

        // Pastikan unit belum pernah dikirim
        if (Pengiriman::where('detailasset_id', $request->detailasset_id)->exists()) {
            return back()->with('error', 'Unit ini sudah pernah dikirim.');
        }

        DB::beginTransaction();
        try {
            // Buat pengiriman
            $pengiriman = Pengiriman::create([
                'detailasset_id'     => $request->detailasset_id,
                'tanggal_pengiriman' => $request->tanggal_pengiriman,
                'pic_pengirim'       => $request->pic_pengirim,
                'pic_penerima'       => $request->pic_penerima,
            ]);

            // Ambil durasi & harga dari project
            $project = Project::findOrFail($request->project_id);
            $periodeMulai = Carbon::parse($request->tanggal_pengiriman);
            $periodeAkhir = $periodeMulai->copy()->addMonths($project->durasi_kontrak);

            // Buat rental
            Rental::create([
                'project_id'    => $project->id,
                'pengiriman_id' => $pengiriman->id,
                'status'        => 'aktif',
                'periode_mulai' => $periodeMulai,
                'periode_ahir'  => $periodeAkhir,
                'total_tagihan' => $project->harga_sewa,
            ]);

            DB::commit();
            return back()->with('success', 'Pengiriman dan rental berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Gagal menyimpan data.',
                'detail' => $e->getMessage(),
            ]);
        }
    }

    public function projecttampil(Project $project)
    {

        return view('components.project', compact('project'));
    }
}

