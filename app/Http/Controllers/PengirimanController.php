<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengiriman;
use App\Models\Pengirimandetail;   // pastikan nama model sesuai
use App\Models\Rental;             // ⬅️  tambahkan
use App\Models\Asset;

class PengirimanController extends Controller
{
    /** GET /project/{id}/pengiriman */
    public function pengirimanByProject($id)
    {
        $project    = \App\Models\Project::findOrFail($id);
        $pengiriman = Pengiriman::where('project_id', $id)->with('details')->get();
        $assets     = Asset::all();

        return view('components.pengiriman', compact('project', 'pengiriman', 'assets'));
    }

    /** POST /pengiriman */
    public function kirim(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'project_id'         => 'required|integer|exists:projects,id',
            'tanggal_pengiriman' => 'required|date',
            'pic_pengirim'       => 'required|string|max:255',
            'pic_penerima'       => 'required|string|max:255',
            'asset_id'           => 'required|exists:assets,id',
            'keterangan'         => 'nullable|string',
        ]);

        // 2. Cegah asset yang sudah pernah dikirim
        $assetSudahDikirim = Pengirimandetail::where('asset_id', $request->asset_id)->exists();
        if ($assetSudahDikirim) {
            return back()->with('error', 'Asset ini sudah pernah dikirim dan tidak bisa digunakan kembali.');
        }

        DB::beginTransaction();
        try {
            /* 3. Simpan pengiriman utama */
            $pengiriman = Pengiriman::create([
                'project_id'         => $request->project_id,
                'tanggal_pengiriman' => $request->tanggal_pengiriman,
                'pic_pengirim'       => $request->pic_pengirim,
                'pic_penerima'       => $request->pic_penerima,
            ]);

            /* 4. Simpan detail pengiriman */
            $detail = Pengirimandetail::create([
                'pengiriman_id' => $pengiriman->id,
                'asset_id'      => $request->asset_id,
                'jumlah_unit'   => 1,                       // ganti jika ada field jumlah
                'keterangan'    => $request->keterangan,
            ]);

            /* 5. ⬅️  Buat baris rental otomatis (status default = 'aktif') */
            Rental::create([
                'asset_id'             => $detail->asset_id,
                'project_id'           => $pengiriman->project_id,
                'pengiriman_detail_id' => $detail->id,
                // kolom status tidak perlu: sudah default 'aktif'
            ]);

            DB::commit();
            return back()->with('success', 'Pengiriman & rental berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors([
                'error'  => 'Gagal menyimpan pengiriman.',
                'detail' => $e->getMessage(),
            ]);
        }
    }
}

