<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportTicketReplys extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketNumber;
    public $replyMessage;

     public function __construct($ticketNumber, $replyMessage)
    {
        $this->ticketNumber = $ticketNumber;
        $this->replyMessage = $replyMessage;
    }

    public function build()
    {
        return $this->subject('Support Ticket Reply')->view('emails.support_ticket_reply');
    }
}
