<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AssetController extends Controller
{
    //
        public function asset()
    {
        //Menampilkan data Asset
        $data = asset::all();
        return view('management-asset.asset', compact('data'));
    }

    public function addasset(Request $request)
    {
        $validmerk=['Asus','Acer','Dell','Hp','Lenovo'];

        $validkondisi=['Normal','Rusak'];

        $request->validate([
            'merk'=>['required', Rule::in($validmerk)],
            'type'=>'required|string|max:50',
            'serialnumber'=>'required|string|max:50|unique:assets,serialnumber',
            'spesifikasi'=>'required|string|max:50',
            'tanggal_pembelian'=>'required|date',
            'harga_pembelian'=>'required|numeric',
            'kondisi'=>['required',Rule::in($validkondisi)],
        ]);

        $asset =new asset();
        
            $asset->merk = $request->merk;
            $asset->type = $request->type;
            $asset->serialnumber = $request->serialnumber;
            $asset->spesifikasi = $request->spesifikasi;
            $asset->tanggal_pembelian = $request->tanggal_pembelian;
            $asset->harga_pembelian = $request->harga_pembelian;
            $asset->kondisi = $request->kondisi;

            $asset->save();

            return redirect()->route('management-asset/asset')->with('success','Asset Berhasil Ditambahkan');
        }
}   

