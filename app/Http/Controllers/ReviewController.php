<?php

// app/Http/Controllers/ReviewController.php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $review = Review::create($request->all());

        return response()->json($review, 201);
    }

    // Add other CRUD methods as needed
}
