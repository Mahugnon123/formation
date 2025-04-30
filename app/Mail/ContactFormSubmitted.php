<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->contactData['email'], $this->contactData['name'])
                    ->to(env('MAIL_CONTACT_ADDRESS')) // Adresse e-mail de l'entreprise (à configurer dans .env)
                    ->subject('Nouveau message de contact depuis le site web')
                    ->view('emails.contact_form_submitted'); // Vue Blade pour le contenu de l'e-mail
    }
}