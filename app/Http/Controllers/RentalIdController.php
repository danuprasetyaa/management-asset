<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentalIdController extends Controller
{
    public function projecttampil(Project $project)
    {
        $project->load('rentals');             

        //dd($project->id, $project->rentals->toArray());   
        return view('components.project', compact('project'));
    }

    /* POST /rental */
    public function tampilrental(Request $request)
    {
        $request->validate([
            'asset_id'            => ['required', 'exists:assets,id'],
            'project_id'          => ['required', 'exists:projects,id'],
            'pengiriman_detail_id'=> [
                'required',
                'exists:pengiriman_detail,id',
                Rule::unique('rental', 'pengiriman_detail_id'), // hindari double-input
            ],
        ]);

        // status -> otomatis 'aktif' via default attribute
        Rental::create([
            'asset_id'            => $request->asset_id,
            'project_id'          => $request->project_id,
            'pengiriman_detail_id'=> $request->pengiriman_detail_id,
        ]);

        return to_route('project.show', $request->project_id)
               ->with('success', 'Data rental berhasil ditambahkan!');
    }
}
