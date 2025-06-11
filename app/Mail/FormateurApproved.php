<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;




class FormateurApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $request;
     public $password;

     public function __construct($request, $password)
    {
        $this->request = $request;
        $this->password = $password;
    }
    

public function build()
{
    return $this->subject('Bienvenue en tant que formateur !')
                ->view('Admin.formateur_approved')
                ->with([
                    'nom_complet' => $this->request->nom_complet,
                    'email' => $this->request->email,
                    'password' => $this->password
                ]);
}

    /**
     * Get the message envelope.
     */
   

    /**
     * Get the message content definition.
     */
   
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
