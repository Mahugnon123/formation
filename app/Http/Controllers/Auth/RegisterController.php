<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|in:1,2',
        ]);

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'slug' => Str::slug($validated['nom'] . '-' . $validated['prenom'] . '-' . time()),
        ]);

        Auth::login($user);

        // Si la requête attend du JSON (AJAX)
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Inscription réussie !',
                'redirect' => route('home')
            ]);
        }

        // Sinon, redirection classique avec message de succès
        return redirect()->route('home')->with('message', 'Inscription réussie !');
    }
}