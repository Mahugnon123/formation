<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\User;
use App\Models\UserFormation;
use Notification;
use App\Notification\FormateurNotification;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        if (auth()->user()->role_id==1) {
            $formation_all = Formation::all();
            $userformation = UserFormation::where('user_id',auth()->user()->id)->first();
            return view('Apprenant.index',compact('userformation','formation_all'));
        }

        if (auth()->user()->role_id==2) {
            $formation = formation::where('user_slug',auth()->user()->slug)->get();
            return view("Formateur.index",compact('formation'));
        }

        if (auth()->user()->role_id==3) {
            return view("Admin.index");
        }
        auth()->user()->last_connexion = date('d/m/Y H:i:s');

    }
}

