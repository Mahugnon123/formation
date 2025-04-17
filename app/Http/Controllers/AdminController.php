<?php

namespace App\Http\Controllers;
use App\Models\UserFormation;
use App\Models\Formation;
use App\Models\User;
use App\Models\Category;
use App\Helpers;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Hash;
use App\Notifications\FormateurNotification;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function store(Request $request){
       $user =  User::create([
           
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'role_id' =>$request->role_id,
            'sex' =>$request->sex,
            'slug' => Helpers::generateSlug(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $details =[
            'greeting' => "Felicitation, Vous venez d'etre inscrit comme formateur cher '.$user->nom.",
            'body' => "Voici vos identifiant de connexion: Email: '.$user->email. ' Mot de passe: ".$request->password,
            'actiontext' =>'Cliquer sur ce lien pour vous connecter et changer vos identifiant! ',
            'actionurl' => '/login',
            'lastline' => 'Bienvenu dans la communaute!'

        ];

        //Notification::send($user, new FormateurNotification($details));
        return redirect()->back();
    }

    public function status(Request $request){

        Formation::where('slug',$request->slug)->update([
            'status' =>	    $request->status
            ]);
            return Response()->json($request->status );

    }
    
    public function users(){
        $formateurs = User::withTrashed()->where('role_id','=',2)->get();
        $formations = Formation::all();
        $students = UserFormation::all();
        $users = User::withTrashed()->where('role_id','<>',3)->get();
        $userAll = User::withTrashed()->get();

        return view('Admin.allCompoment',compact('users','formateurs','formations','students','userAll'));
    }
    
    public function destroy(Request $request)
    {
        $user = User::where('slug', $request->slug)->first();
        if($user!=null){
            $user->delete();
        }
        $ok = 'Desa';
        return Response()->json($ok );
    }
    public function restore(Request $request){
        $ok = 'Acti';
        $user = User::withTrashed()->where('slug', $request->slug)->restore();
        $ok = ($user !=null)?true:'Act';
        return Response()->json($ok );
    }


    /** categories */
    public function categories(){
        $categories = Category::all();
        return view('Admin.category', compact('categories'));        
    }
    public function categorieCreer(Request $request){
        $categories = Category::where('nom', $request->nom)->first();
        if($categories == null){
            Category::create([
                'nom' => $request->nom,
                'description' => $request->description
            ]);
        }else{
            return redirect('Admin.category')->with('message', 'Votre categorie a ete creer avec succe!');
        }
        
    }
    public function categorieModifier(Request $request){
        Category::where('nom', $request->nom)->update([
            'nom' => $request->nom,
            'description' => $request->description
                ]);
        return redirect('Admin.category')->with('message', 'Votre categorie a ete modifier avec succe!');

    }
    public function categorieDelete($slug){
        Category::where('nom', $slug)->first()->delete();
        return redirect()->back()->with('message', 'Votre categorie a ete supprimer avec succe!');
    }


}
