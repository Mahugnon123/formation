<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormateurRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function build()
    {
        return $this->subject('Statut de votre demande')
                    ->view('Admin.formateur_rejected')
                    ->with(['nom_complet' => $this->request->nom_complet]);
    }
}