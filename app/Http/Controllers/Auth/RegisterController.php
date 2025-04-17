<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserFormation;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = Request();
        $folder_photo_profil = "/photo_profil/";
        if($request->hasFile('photo_profil'))
            {
                $user = $request->file('photo_profil');
                $nomphoto = Str::random(10)."-".time().'.png';
                $user->move(public_path($folder_photo_profil), $nomphoto);
                $destination_photo = /*"/public".*/$folder_photo_profil.$nomphoto;
                
            }
       $user= User::create([
           
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'role_id' => $data['role_id'],
            'slug' => Helpers::generateSlug(),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
         
         auth()->attempt([
        'email' => $data['email'],
        'password' => $data['password'],
         ]);

        $id = 0;
        $id = $request->input('id');
        $fmts =  [];
        $id_fmt = 0;
        $bool = false;
        $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
        
        /**Association de l'utilisateur a ses formations */
        if($userfmt == null){
            $formations[0]= [
                "id"=>$id,
                "status"=> "Inscrire",
                "progression" => 0
            ];
            UserFormation::create([
                'user_id' => auth()->user()->id ,
                'formations' =>json_encode($formations),
            ]);

        }else{
                $formations = (is_array($userfmt->formations))? $userfmt->formations:json_decode($userfmt->formations,true);
    
            for($i=0; $i<count($formations);$i++){
                if($id!=$formations[$i]["id"]){
                   $bool = true;
                }else{
                    $bool = false;
                    $id_fmt = $i;
                    break;
                }
            }
            if($bool==true){
                $formations[$id_fmt+1]["id"] = $id;
                $formations[$id_fmt+1]["status"] = "Inscrire";
                $formations[$id_fmt+1]["progression"] = 0;

                UserFormation::where('user_id',auth()->user()->id )->update([
                    'formations' =>json_encode($formations),
                ]);
            }
        
        }
       return $user;

    }
}
