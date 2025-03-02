<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportTicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketNumber;

     public function __construct($ticketNumber)
    {
        $this->ticketNumber = $ticketNumber;
    }

    public function build()
    {
        return $this->subject('Support Ticket Created')->view('emails.support_ticket_created');
    }
}
