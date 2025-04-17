<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function update(Request $request)
    {
        /*$user = User::where('id', auth()->user()->id)->update([
            'nom' =>$request->input('nom'),
            'prenom' =>$request->input('prenom'),
            'pays' =>$request->input('pays'),
            'birthday' =>$request->input('birthday'),
            'email' =>$request->input('email'),
            'contact' =>$request->input('phone'),

        ]);*/
        $user = User::where('id', auth()->user()->id)->first();

        $folder_photo_profil = "/photo_profil/";
        if($request->input('profile_photo')!=null)
            {
                $newImageName = Str::random(10)."-".time() . '.' .
                $request->profile_photo->extension();
                $request->profile_photo->move(public_path('photo_profil'), $newImageName);
            }
            else{
                $newImageName = $user->photo_profil;
            }
        $link_info = [

            'site' => $request->input('site'),
            'linkedIn' => $request->input('LinkedIn'),
            'facebook' => $request->input('Facebook'),
        ];
         User::where('id', auth()->user()->id)->update([
            'pseudo' =>$request->input('pseudo'),
            'nom' =>$request->input('nom'),
            'prenom' =>$request->input('prenom'),
            'pays' =>$request->input('pays'),
            'birthday' =>$request->input('birthday'),
            'biographie' =>$request->input('biographie'),
            'a_propos' =>$request->input('a_propos'),
            'sex' =>$request->input('sex'),
            'link_info' => json_encode($link_info),
            'contact' =>$request->input('phone'), 
            'photo_profil' => $newImageName

        ]);
        return Response()->json(array("resultat"=>$request->input('profile_photo')));
    }

    public function updatePassword(Request $request){

        if(Hash::make($request->pwd2) == auth()->user()->password){
            User::where('id', auth()->user()->id)->update([
                'password' =>Hash::make($request->pwd3),
            ]);
            return Response()->json(array("resultat"=>'ok'));
    
        }
    }
    public function updateEmail(Request $request){

        User::where('id', auth()->user()->id)->update([
            'email' =>$request->newMail,
        ]);
        return Response()->json(array("resultat"=>'ok'));

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
}
