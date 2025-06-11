<?php



namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\UserFormation;
use App\Models\Formation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Formateur;
use Yajra\DataTables\DataTables;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    return view('Admin.formateur', [
        'formateurs' => User::where('role_id', 2)->get(),
        'formations' => Formation::all(),
        'students' => User::where('role_id', 3)->get(),
        'userAll' => User::all(),
    ]);
    }

    public function create()
    {
        return view('Admin.formateur');
    }

    public function edit($id)
    {
        $formateur = User::findOrFail($id);
        return view('Admin.formateur', compact('formateur'));
    }

    public function status(Request $request)
    {
        Formation::where('slug', $request->slug)->update([
            'status' => $request->status
        ]);
        return response()->json($request->status);
    }

    public function updateFormationStatus(Request $request)
    {
    $formation = Formation::where('slug', $request->slug)->firstOrFail();
    $formation->status = $request->status;
    $formation->save();
    return response()->json(['message' => 'Statut de la formation mis à jour']);
    }

    
    public function users()
    {
        $formateurs = User::withTrashed()->where('role_id', 2)->get();
        $formations = Formation::all();
        $students = UserFormation::all();
        $users = User::withTrashed()->where('role_id', '<>', 3)->get();
        $userAll = User::withTrashed()->get();

        return view('Admin.allCompoment', compact('users', 'formateurs', 'formations', 'students', 'userAll'));
    }
//Gère archiver et restaurer de la page formateur
    public function destroy(Request $request)
    {
        $user = User::where('slug', $request->slug)->first();
        if ($user) {
            $user->delete();
            return response()->json('Utilisateur supprimé avec succès');
        }
        return response()->json('Utilisateur non trouvé', 404);
    }

    public function restore(Request $request)
    {
        $user = User::withTrashed()->where('slug', $request->slug)->first();
        if ($user) {
            $user->restore();
            return response()->json(true);
        }
        return response()->json('Utilisateur non trouvé', 404);
    }


    
   
}