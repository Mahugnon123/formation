<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\UserFormation;
use App\Models\Formation;
use App\Models\Formateur;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id',auth()->user()->id)->first();
        //var_dump($user->link_info);
        return view('Apprenant.show', compact("user"));
    }
    

    public function getStudents(Request $request)
    {
        if ($request->ajax()) {
            try {
                $students = User::select(
                    'users.id',
                    'users.nom',
                    'users.prenom',
                    'users.slug',
                    'users.deleted_at',
                    DB::raw('COUNT(user_formations.id) as total_formations'),
                    DB::raw('COUNT(CASE WHEN user_formations.statut = "Terminée" THEN 1 END) as certificats')
                )
                    ->withTrashed()
                    ->leftJoin('user_formations', 'users.id', '=', 'user_formations.user_id')
                    ->where('users.role_id', 1)
                    ->groupBy('users.id', 'users.nom', 'users.prenom', 'users.slug', 'users.deleted_at');
    
                    return DataTables::of($students)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('search') && $request->search['value'] !== '') {
                            $search = $request->search['value'];
                            $query->where(function($q) use ($search) {
                                $q->where('users.nom', 'like', "%{$search}%")
                                  ->orWhere('users.prenom', 'like', "%{$search}%");
                            });
                        }
                    })
                    ->addColumn('nom', function ($student) {
                        return '<span style="width: 150px; display: inline-block;">' . $student->nom . '</span>';
                    })
                                    
                    ->addColumn('prenom', function ($student) {
                        return '<span style="width: 150px; display: inline-block;">' . $student->prenom . '</span>';
                    })
                    ->addColumn('formations', function ($student) {
                        return '<span style="width: 120px; display: inline-block;">' . $student->total_formations . ' formation(s)</span>';
                    })
                    ->addColumn('certificats', function ($student) {
                        return '<span style="width: 120px; display: inline-block;">' . $student->certificats . ' certificat(s)</span>';
                    })
                    ->addColumn('compte', function ($student) {
                        static $j = 0;
                        $j++;
                        $slug = $student->slug ?? 'default-slug-' . $student->id;
                        return '<div style="width: 150px; display: inline-block;">' .
                            '<form action="javascript:void(0)" method="post">' .
                            '<input type="hidden" id="slg' . $j . '" name="acts[]" value="' . $slug . '">' .
                            '<button class="btn bg-warning" type="submit" id="desactivation' . $j . '" data-element="' . $j . '">' .
                            '<span id="desabled' . $j . '">' . ($student->deleted_at ? 'Activer' : 'Désactiver') . '</span>' .
                            '</button></form></div>';
                    })
                    ->rawColumns(['nom', 'prenom', 'formations', 'certificats', 'compte']) // Ne pas oublier ça !
                    ->setRowId('id')
                    ->make(true);
            } catch (\Exception $e) {
                \Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    
        return view('admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

   
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

      public function updateFormateur(Request $request)
{
    // Validation des données (inchangée)
         $validated = $request->validate([
             'pseudo' => 'nullable|string|max:255',
             'nom' => 'required|string|max:255',
             'prenom' => 'required|string|max:255',
             'pays' => 'nullable|string|max:255',
             'birthday' => 'nullable|date',
             'biographie' => 'nullable|string',
             'a_propos' => 'nullable|string|max:100',
             'sex' => 'required|in:M,F,A',
             'phone' => 'nullable|string|max:20|unique:users,contact,' . auth()->user()->id,
             'site' => 'nullable|url',
             'LinkedIn' => 'nullable|url',
             'Facebook' => 'nullable|url',
             'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
         ]);
     
         $user = User::where('id', auth()->user()->id)->first();
     
         // Gestion de la photo de profil
         if ($request->hasFile('profile_photo')) {
             
     
             $newImageName = Str::random(10) . "-" . time() . '.' . $request->file('profile_photo')->extension();
             $request->file('profile_photo')->storeAs('public/photo_profil', $newImageName);
         } else {
             $newImageName = $user->photo_profil;
         }
     
         // Préparation des liens (inchangée)
         $link_info = [
             'site' => $request->input('site'),
             'linkedIn' => $request->input('LinkedIn'),
             'facebook' => $request->input('Facebook'),
         ];
     
         // Mise à jour de l'utilisateur (inchangée)
         try {
             $user->update([
                 'pseudo' => $request->input('pseudo'),
                 'nom' => $request->input('nom'),
                 'prenom' => $request->input('prenom'),
                 'pays' => $request->input('pays'),
                 'birthday' => $request->input('birthday'),
                 'biographie' => $request->input('biographie'),
                 'a_propos' => $request->input('a_propos'),
                 'sex' => $request->input('sex'),
                 'link_info' => json_encode($link_info),
                 'contact' => $request->input('phone'),
                 'photo_profil' => $newImageName,
             ]);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()], 500);
         }

    return response()->json(['redirect' => '/formateur/profil']);
}

    /* public function updatePassword(Request $request)
    {
        $request->validate([
            'pwd2' => 'required',
            'pwd3' => 'required|min:8|confirmed', // Ajoute la validation confirmed
            'pwd3_confirmation' => 'required' //pour que confirmed marche
        ]);
        if (Hash::check($request->pwd2, auth()->user()->password)) { // Use Hash::check()
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->pwd3),
            ]);
            return response()->json(['resultat' => 'ok']);
        } else {
             return response()->json(['resultat' => 'error'], 400); //pour gerer l'erreur
        }
    
    } */

     
     public function update(Request $request)
     {
         // Validation des données (inchangée)
         $validated = $request->validate([
             'pseudo' => 'nullable|string|max:255',
             'nom' => 'required|string|max:255',
             'prenom' => 'required|string|max:255',
             'pays' => 'nullable|string|max:255',
             'birthday' => 'nullable|date',
             'biographie' => 'nullable|string',
             'a_propos' => 'nullable|string|max:100',
             'sex' => 'required|in:M,F,A',
             'phone' => 'nullable|string|max:20|unique:users,contact,' . auth()->user()->id,
             'site' => 'nullable|url',
             'LinkedIn' => 'nullable|url',
             'Facebook' => 'nullable|url',
             'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
         ]);
     
         $user = User::where('id', auth()->user()->id)->first();
     
         // Gestion de la photo de profil
         if ($request->hasFile('profile_photo')) {
             
     
             $newImageName = Str::random(10) . "-" . time() . '.' . $request->file('profile_photo')->extension();
             $request->file('profile_photo')->storeAs('public/photo_profil', $newImageName);
         } else {
             $newImageName = $user->photo_profil;
         }
     
         // Préparation des liens (inchangée)
         $link_info = [
             'site' => $request->input('site'),
             'linkedIn' => $request->input('LinkedIn'),
             'facebook' => $request->input('Facebook'),
         ];
     
         // Mise à jour de l'utilisateur (inchangée)
         try {
             $user->update([
                 'pseudo' => $request->input('pseudo'),
                 'nom' => $request->input('nom'),
                 'prenom' => $request->input('prenom'),
                 'pays' => $request->input('pays'),
                 'birthday' => $request->input('birthday'),
                 'biographie' => $request->input('biographie'),
                 'a_propos' => $request->input('a_propos'),
                 'sex' => $request->input('sex'),
                 'link_info' => json_encode($link_info),
                 'contact' => $request->input('phone'),
                 'photo_profil' => $newImageName,
             ]);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()], 500);
         }
     
         return response()->json(['redirect' => '/profile']);


     }

  
public function updatePassword(Request $request)
{
    // Validation côté backend
    $request->validate([
        'pwd_actu' => 'required',
        'pwd_modif' => 'required|string|min:8|confirmed', // Laravel attend pwd_modif_confirmation
    ]);

    // Vérifier si le mot de passe actuel est correct
    if (Hash::check($request->input('pwd_actu'), auth()->user()->password)) {
        User::where('id', auth()->id())->update([
            'password' => Hash::make($request->input('pwd_modif')),
        ]);
        return response()->json(['resultat' => 'ok']);
    } else {
        return response()->json(['resultat' => 'error', 'message' => 'Mot de passe actuel incorrect']);
    }
}

   public function updateEmail(Request $request)
{
    try {
        User::where('id', auth()->user()->id)->update([
            'email' => $request->newMail,
        ]);
        return response()->json(['resultat' => 'ok']);
    } catch (\Exception $e) {
        return response()->json(['resultat' => 'erreur', 'message' => $e->getMessage()], 500);
    }
}

    public function delete(){
        User::where('id', auth()->user()->id)->first()->delete();
       return redirect('auth.login');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showFormateurProfile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('formateur.show', compact("user"));
    }

    //Activer/archiver pour la page utilisateur
    public function activate($id)
    {
    $user = User::withTrashed()->findOrFail($id);

    if ($user->role_id == 1) {
        $user->restore();
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Apprenant activé avec succès.'
            ]);
        }
        return redirect()->back()->with('message', 'Apprenant activé avec succès.');
    }

    if (request()->ajax()) {
        return response()->json([
            'success' => false,
            'message' => 'Seuls les apprenants peuvent être activés.'
        ], 403);
    }
    return redirect()->back()->with('error', 'Seuls les apprenants peuvent être activés.');
    }

    public function deactivate($id)
    {
    $user = User::findOrFail($id);

    if ($user->role_id == 1) {
        $user->deleted_at = now();
        $user->save();
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Apprenant désactivé avec succès.'
            ]);
        }
        return redirect()->back()->with('message', 'Apprenant désactivé avec succès.');
    }

    if (request()->ajax()) {
        return response()->json([
            'success' => false,
            'message' => 'Seuls les apprenants peuvent être désactivés.'
        ], 403);
    }
    return redirect()->back()->with('error', 'Seuls les apprenants peuvent être désactivés.');
    }
     
    
    
    public function archive($id)
    {
        $user = User::findOrFail($id);
    
        if ($user->role_id == 2) { // Formateur
            $user->delete(); // Soft delete
            return redirect()->back()->with('message', 'Formateur archivé avec succès.');
        }
    
        return redirect()->back()->with('error', 'Seuls les formateurs peuvent être archivés.');
    }
    
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
    
        if ($user->role_id == 2) { // Formateur
            $user->restore();
            return redirect()->back()->with('message', 'Formateur restauré avec succès.');
        }
    
        return redirect()->back()->with('error', 'Seuls les formateurs peuvent être restaurés.');
    }
}
