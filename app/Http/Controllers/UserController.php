<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


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

    $user = User::findOrFail(auth()->user()->id);

    // Gestion de la photo de profil
    if ($request->hasFile('profile_photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($user->photo_profil && Storage::exists('public/photo_profil_formateur/' . $user->photo_profil)) {
            Storage::delete('public/photo_profil_formateur/' . $user->photo_profil);
        }

        $newImageName = Str::random(10) . "-" . time() . '.' . $request->file('profile_photo')->extension();
        $request->file('profile_photo')->storeAs('public/photo_profil_formateur', $newImageName);
        $validated['photo_profil'] = $newImageName;
    }

    // Préparation des liens
    $link_info = [
        'site' => $request->input('site'),
        'linkedIn' => $request->input('LinkedIn'),
        'facebook' => $request->input('Facebook'),
    ];
    $validated['link_info'] = json_encode($link_info);

    // Mise à jour de l'utilisateur
    try {
        $user->update($validated);
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
             // Supprimer l'ancienne photo si elle existe
             if ($user->photo_profil && \Storage::exists('public/photo_profil/' . $user->photo_profil)) {
                 \Storage::delete('public/photo_profil/' . $user->photo_profil);
             }
     
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
    // S'assurer que les bons noms de champs sont utilisés
    $pwd_actu = $request->input('pwd_actu');
    $pwd_modif = $request->input('pwd_modif');

    // Vérifier si le mot de passe actuel est correct
    if (Hash::check($pwd_actu, auth()->user()->password)) {
        // Mettre à jour le mot de passe
        User::where('id', auth()->id())->update([
            'password' => Hash::make($pwd_modif),
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
}
