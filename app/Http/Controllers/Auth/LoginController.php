<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    $user = User::withTrashed()->where('email', $request->email)->first();

    if (!$user || $user->trashed()) {
        throw ValidationException::withMessages([
            'email' => ['Your account is not activated or does not exist.'],
        ]);
    }

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        // Si la requête attend du JSON (AJAX)
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Connexion reussie!',
                'redirect' => route('home')
            ]);
        }

        // Sinon, redirection classique
        return redirect()->intended(route('home'));
    }

    throw ValidationException::withMessages([
        'email' => ['Incorrect email or password.'],
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('message', 'Déconnexion réussie');
    }
}