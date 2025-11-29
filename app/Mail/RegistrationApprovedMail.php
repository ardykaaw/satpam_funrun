<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Registration $registration;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration)
    {
        // Use EXACT same pattern as RegistrationConfirmationMail
        $this->registration = $registration;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        // Use different subject to avoid Gmail filtering
        return $this->subject('Pendaftaran Anda Telah Disetujui - Satpam Fun Run 5K')
            ->view('emails.registration_approved');
    }
}


