<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IPTVChannel;

class IPTVChannelController extends Controller
{
    public function index()
    {
        $channels = IPTVChannel::all();

        return response()->json($channels);
    }
}
