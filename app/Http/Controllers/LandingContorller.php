<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Rental;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class LandingContorller extends Controller
{
    public function dasboard()
    {
        $totalasset = Asset::count();
        $totalrental = Rental::count();

        //Bar chart – 6 bulan terakhir
        $start   = Carbon::now()->startOfMonth()->subMonths(5);       // Ambil 6 Bulan Terahir
        $period = collect($start->monthsUntil(Carbon::now()->startOfMonth())); 
        $months = $period->map(fn ($c) => $c->format('M'))->values();


        $assetMap  = Asset ::selectRaw('DATE_FORMAT(created_at, "%Y-%m") ym, COUNT(*) total')
                           ->whereDate('created_at', '>=', $start)
                           ->groupBy('ym')->pluck('total', 'ym');
        $rentalMap = Rental::selectRaw('DATE_FORMAT(created_at, "%Y-%m") ym, COUNT(*) total')
                           ->whereDate('created_at', '>=', $start)
                           ->groupBy('ym')->pluck('total', 'ym');

        $assetPerMonth = [];
        $rentPerMonth  = [];
        foreach ($period as $d) {
            $key = $d->format('Y-m');
            $assetPerMonth[] = $assetMap [$key] ?? 0;
            $rentPerMonth [] = $rentalMap[$key] ?? 0;
        }

        //Pie chart
        $now = Carbon::now();
        $byProject = Rental::select('project_id', DB::raw('COUNT(*) total'))
            ->whereYear ('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->groupBy('project_id')
            ->with('project:id,nama')      
            ->get();

        $pieLabels = $byProject->pluck('project.nama')->toArray();
        $pieData   = $byProject->pluck('total')->toArray();

        $baseColors = ['#0077FF','#FFDE59','#3B3F40','#FFE9C7','#F2994C',
                       '#00B894','#A29BFE','#FD79A8'];
        $pieColors  = array_slice($baseColors, 0, count($pieLabels));

        // Send to view
        return view('management-asset.dasboard', [
            'totalasset'    => $totalasset,
            'totalrental'   => $totalrental,
            'months'        => $months,          // ['Jan', 'Feb', …]
            'assetPerMonth' => $assetPerMonth,   // [12,  8, …]
            'rentPerMonth'  => $rentPerMonth,    // [ 3,  5, …]
            'pieLabels'     => $pieLabels,       // ['Huawei MS XL', …]
            'pieData'       => $pieData,         // [25, 35, …]
            'pieColors'     => $pieColors,       // ['#0077FF', …]
            'monthName'     => $now->format('F'),// "June"
            'year'          => $now->year,       // 2025
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
