<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'profile_url' => 'required|string',
            'gender' => 'required|string',
        ]);

        $cast = Cast::create($validatedData);

        return response()->json($cast, 201);
    }

    // Implement other CRUD methods as needed
}
