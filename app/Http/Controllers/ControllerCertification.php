<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use App\Models\Certification;
use App\Models\UserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class ControllerCertification extends Controller
{
  /*   public function __construct()
    {
        $this->middleware('auth')->except('verify');
    } */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
   /*  public function store(Request $request, Formation $formation)
    {
        $user = Auth::user();

        // Vérifier si la formation est validée pour cet utilisateur
        $userTest = UserTest::where('user_id', $user->id)
            ->where('formation_id', $formation->id)
            ->where('status', 'Validé')
            ->first();

        if (!$userTest) {
            return $this->errorResponse($request, 'Vous devez valider la formation pour obtenir un certificat.');
        }

        // Vérifier si la certification existe déjà
        $certification = Certification::where('user_id', $user->id)
            ->where('formation_id', $formation->id)
            ->first();

        if (!$certification) {
            $certification = Certification::create([
                'dateFinFormation' => now(),
                'appreciation' => 'Félicitations, formation validée !',
                'user_id' => $user->id,
                'formation_id' => $formation->id,
                // 'certificate_id' => Str::uuid(), // Ajoute ce champ si tu l'as dans ta table
            ]);
        }

        // Si tu veux un identifiant unique pour le certificat (optionnel)
        if (empty($certification->certificate_id) && \Schema::hasColumn('certifications', 'certificate_id')) {
            $certification->certificate_id = Str::uuid();
            $certification->save();
        }

        // Générer le lien sécurisé
        $signedUrl = URL::signedRoute(
            'certification.view',
            ['certificate_id' => $certification->certificate_id ?? $certification->id]
        );

        // Envoyer l'e-mail
        Mail::send('emails.certificate', [
            'user' => $user,
            'formation' => $formation,
            'url' => $signedUrl
        ], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Votre certificat est prêt !')
                ->from('no-reply@tondomaine.com', 'Votre Plateforme');
        });

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Certificat généré avec succès ! Un e-mail vous a été envoyé.',
                'certificate_url' => $signedUrl,
            ]);
        }

        return redirect()->route('home')->with('message', 'Certificat généré ! Vérifiez votre e-mail pour le lien sécurisé.');
    } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($certificate_id)
    {
        $certification = Certification::where('certificate_id', $certificate_id)->firstOrFail();

        if (!URL::hasValidSignature(request())) {
            abort(403, 'Lien de certificat invalide ou falsifié.');
        }

        // if ($certification->user_id !== Auth::id()) {
        //     abort(403, 'Accès non autorisé.');
        // }

        return view('certifications.view', [
            'certification' => $certification,
            'nom' => strtoupper($certification->user->nom),
            'prenom' => ucwords(strtolower($certification->user->prenom)),
            'course' => $certification->formation->titre,
            'date' => $certification->dateFinFormation ? $certification->dateFinFormation->format('d/m/Y') : '',
            'certificate_id' => $certification->certificate_id ?? $certification->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Vérifier l'authenticité d'un certificat.
     */
   /*  public function verify(Request $request)
    {
        $request->validate(['certificate_id' => 'required|string']);

        $certification = Certification::where('certificate_id', $request->certificate_id)
            ->orWhere('id', $request->certificate_id)
            ->with(['user', 'formation'])
            ->first();

        if (!$certification) {
            return redirect()->back()->withErrors(['certificate_id' => 'Certificat introuvable.']);
        }

        return view('certifications.verify', [
            'certification' => $certification,
            'name' => $certification->user->nom . ' ' . $certification->user->prenom,
            'course' => $certification->formation->titre,
            'date' => $certification->dateFinFormation ? $certification->dateFinFormation->format('d/m/Y') : '',
        ]);
    }

    protected function errorResponse(Request $request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => $message], 422);
        }
        return redirect()->back()->withErrors(['error' => $message]);
    } */
}
