<?php

namespace App\Http\Controllers;

use App\Models\PartnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\FormateurApproved;
use App\Mail\FormateurRejected;

class PartnerRequestController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validation des données du formulaire
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:partner_requests,email',
            'telephone' => 'required|string|max:20',
            'sex' => 'required|in:M,F',
            'domaines_expertise' => 'required|string',
            'linkedin' => 'nullable|url|max:255',
            'presentation' => 'required|string',
            'motivation' => 'required|string',
            'cv' => 'required|file|mimes:pdf|max:2048', // Max 2MB
            'lettre_motivation' => 'required|file|mimes:pdf|max:2048', // Max 2MB
            'certificats.*' => 'nullable|file|mimes:pdf,jpeg,png|max:2048', // Plusieurs fichiers, PDF ou images
            'piece_identite' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'photo_profil' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Enregistrement des fichiers téléchargés
        $cvPath = $request->file('cv')->store('partner_requests/cv', 'public');
        $lettreMotivationPath = $request->file('lettre_motivation')->store('partner_requests/lettres', 'public');
        $pieceIdentitePath = $request->file('piece_identite')->store('partner_requests/identites', 'public');
        $photoProfilPath = $request->file('photo_profil')->store('partner_requests/photos', 'public');

        $certificatsPaths = [];
        if ($request->hasFile('certificats')) {
            foreach ($request->file('certificats') as $certificat) {
                $certificatsPaths[] = $certificat->store('partner_requests/certificats', 'public');
            }
        }

        // 3. Enregistrement des informations dans la base de données
        PartnerRequest::create([
            'nom_complet' => $request->nom_complet,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'sex' => $request->sex,
            'domaines_expertise' => $request->domaines_expertise,
            'linkedin' => $request->linkedin,
            'presentation' => $request->presentation,
            'motivation' => $request->motivation,
            'photo_profil_path' => $photoProfilPath,
            'cv_path' => $cvPath,
            'lettre_motivation_path' => $lettreMotivationPath,
            'piece_identite_path' => $pieceIdentitePath,
            'certificats_paths' => json_encode($certificatsPaths),
        ]);

        // 4. Redirection de l'utilisateur avec un message de succès
        return redirect('/')->with('success', 'Votre demande de partenariat a été envoyée avec succès. Nous vous contacterons prochainement.');
    }
    //rebecca 
    //CE QUE JE VIENS D'Ajouter
public function allRequests()
{
$requests = PartnerRequest::where('statut', 'en_attente')->get();  
  return view('Admin.liste_demande', compact('requests'));
}


    public function index()
    {
        $requests = PartnerRequest::where('statut', 'en_attente')->get();
        return view('admin.partner-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = PartnerRequest::findOrFail($id);
        return view('Admin.show', compact('request'));
    }

    
    public function approve($id)
    {
        $partnerRequest = PartnerRequest::findOrFail($id);
        try {
            DB::beginTransaction();
            Log::info('Approbation démarrée pour la demande ID: ' . $id);

            // Mettre à jour le statut
            $partnerRequest->update(['statut' => 'approuvé']);
            Log::info('Statut mis à jour pour la demande ID: ' . $id);

            // Vérifier si l'email existe déjà
            if (User::where('email', $partnerRequest->email)->exists()) {
                throw new \Exception('Un utilisateur avec cet email existe déjà : ' . $partnerRequest->email);
            }

            // Générer un mot de passe
            $password = Str::random(12);
            Log::info('Mot de passe généré pour la demande ID: ' . $id);

            // Générer un slug
        $slug = Str::slug($partnerRequest->nom_complet . '-' . $partnerRequest->prenom . '-' . uniqid());
Log::info('Slug généré pour la demande ID: ' . $id . ': ' . $slug);

            // Créer l'utilisateur
      $user = User::create([
    'nom' => $partnerRequest->nom_complet,
    'prenom' => $partnerRequest->prenom,
    'email' => $partnerRequest->email,
    'sex' => $partnerRequest->sex ?? 'N/A',
    'contact' => $partnerRequest->telephone,
    'photo_profil' => $partnerRequest->photo_profil_path,
    'role_id' => 2,
    'password' => Hash::make($password),
    'slug' => $slug,
    'created_at' => $partnerRequest->created_at,
]);
            Log::info('Utilisateur créé avec ID: ' . $user->id . ' pour la demande ID: ' . $id);

            // Mettre à jour user_id
            $partnerRequest->update(['user_id' => $user->id]);
            Log::info('user_id mis à jour pour la demande ID: ' . $id . ' avec user_id: ' . $user->id);

            // Envoyer l'email
            Mail::to($partnerRequest->email)->send(new FormateurApproved($partnerRequest, $password));
            Log::info('Email mis en file d\'attente pour la demande ID: ' . $id);

            DB::commit();
            return redirect()->route('admin.notifications')->with('success', 'Demande approuvée.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'approbation de la demande ID: ' . $id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        $partnerRequest = PartnerRequest::findOrFail($id);
        try {
            DB::beginTransaction();
            Log::info('Rejet démarré pour la demande ID: ' . $id);

            $partnerRequest->update(['statut' => 'rejeté']);
            Log::info('Statut mis à jour pour rejet de la demande ID: ' . $id);

            Mail::to($partnerRequest->email)->send(new FormateurRejected($partnerRequest));
            Log::info('Email de rejet mis en file d\'attente pour la demande ID: ' . $id);

            DB::commit();
            return redirect()->route('admin.notifications')->with('success', 'Demande rejetée.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors du rejet de la demande ID: ' . $id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

}