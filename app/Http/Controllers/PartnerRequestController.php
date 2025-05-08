<?php

namespace App\Http\Controllers;

use App\Models\PartnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}