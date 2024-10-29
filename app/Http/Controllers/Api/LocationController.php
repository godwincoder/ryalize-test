<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    //

    public function index(){

        $location = Location::all();
        return response()->json($location);
    }
}
