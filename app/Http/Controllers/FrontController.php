<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FrontController extends Controller
{
    public function index()
{
    $latestFormations = Formation::latest()->take(8)->get();
    $formateurs = User::where('role', 2)->get();

    return view('front.index', compact('latestFormations', 'formateurs'));
}
}
