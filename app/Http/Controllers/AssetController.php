<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\DetailAsset;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AssetController extends Controller
{
    //
        public function asset()
    {
        //Menampilkan data Asset
        $data = Asset::with('detailassets')->get();
        return view('management-asset/asset', compact('data'));
    }

    public function addasset(Request $request)
    {
        $validmerk=['Asus','Acer','Dell','Hp','Lenovo'];

        $validkondisi=['Normal','Rusak'];

        $request->validate([
            'merk'=>['required', Rule::in($validmerk)],
            'type'=>'required|string|max:50',
            'serialnumber'=>'required|string|max:50|unique:detailasset,serialnumber',
            'spesifikasi'=>'required|string|max:50',
            'kondisi'=>['required',Rule::in($validkondisi)],
        ]);

         DB::transaction(function () use ($request) {

            $asset = Asset::firstOrCreate(
                [
                    'merk'        => $request->merk,
                    'type'        => $request->type,
                    'spesifikasi' => $request->spesifikasi,
                ]
            );

            
            $detail = DetailAsset::create([
                'asset_id'     => $asset->id,
                'serialnumber' => $request->serialnumber,
                'kondisi'      => $request->kondisi,
            ]);
        });

        return redirect()
            ->route('management-asset/asset')  
            ->with('success', 'Asset berhasil ditambahkan');
        }
}   

