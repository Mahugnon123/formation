<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 

class ContactController extends Controller
{
    public function handleContactForm(Request $request): RedirectResponse
    {
        // Récupérer les données du formulaire
        $name = $request->input('name');
        $email = $request->input('mail');
        $subject = $request->input('subject');
        $message = $request->input('message');

        // Enregistrer les données dans la base de données
        DB::table('contacts')->insert([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'created_at' => now(),
        ]);

        // Préparer les données pour l'e-mail
        $contactData = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ];

         // Envoyer l'e-mail
        Mail::to(env('MAIL_CONTACT_ADDRESS'))->send(new ContactFormSubmitted($contactData));

        // Message de succès
        $successMessage = 'Votre message a été envoyé avec succès !';

        // Rediriger l'utilisateur vers la page précédente avec le message
        return redirect()->back()->with('temporary_message', $successMessage);
    }
}