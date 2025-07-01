<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        // Vérifions d'abord tous les utilisateurs
        $allUsers = User::all();
      
        
        $teachers = User::where('role_id', 2)->get();
        return view('front.index', compact('teachers'));
    }

    public function show($id)
    {
        $teacher = User::findOrFail($id);
        return view('front.teacher-single', compact('teacher'));
    }
}