<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required|integer',
            'season' => 'required|integer',
            'name' => 'required|string',
            'runtime' => 'required|integer',
            'still_path' => 'required|string',
            'air_date' => 'required|date',
        ]);

        $episode = Episode::create($validatedData);

        return response()->json($episode, 201);
    }

    // Implement other CRUD methods as needed
}
