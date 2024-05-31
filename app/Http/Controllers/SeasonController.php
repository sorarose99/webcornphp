<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tmdb_id' => 'required|integer',
            'name' => 'required|string',
            'episode_count' => 'required|integer',
            'air_date' => 'nullable|date',
            'overview' => 'nullable|string',
            'poster_url' => 'nullable|string',
            'season_number' => 'required|integer',
        ]);

        $season = Season::create($validatedData);

        return response()->json($season, 201);
    }

    // Implement other CRUD methods as needed
}
