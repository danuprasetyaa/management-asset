<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RentalController extends Controller
{
    public function rental()
    {
        // Ambil daftar project dari database
        $data_project = Project::all();
        return view('management-asset.rental', compact('data_project'));  
    }

    public function addproject(Request $request)
    {
        // Validasi Project Masuk
        $request->validate([
            'nama' => 'required|string|max:250|unique:projects,nama',
            'durasi_kontrak' => 'required|int|max:11',
            'harga_sewa'=>'required|numeric',
        ]);

        // Simpan project baru ke database
        $project = new Project();

        $project->nama = $request->nama;
        $project->durasi_kontrak = $request->durasi_kontrak;
        $project->harga_sewa = $request->harga_sewa;

        $project->save();

        // Redirect atau berikan response sukses
        return redirect()->route('management-asset/rental')->with('success', 'Project created successfully!');
    }

}
