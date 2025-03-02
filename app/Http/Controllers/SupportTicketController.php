<?php

namespace App\Http\Controllers;

use App\Mail\SupportTicketCreated;
use App\Mail\SupportTicketReplys;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportTicketController extends Controller
{

    public function index()
    {
        return view("createSupportTicket");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobileNumber' => 'required|string|max:20',
            'problem_description' => 'required|string',
        ]);

        $data = $request->except('_token');

        $ticket_number = 'TICKET-' . strtoupper(uniqid());

        $data['ticketNumber'] = $ticket_number;
        SupportTicket::create($data);

        Mail::to($request->email)->send(new SupportTicketCreated($ticket_number));

        return redirect()->route('SupportTicket')->with('success', $ticket_number.' - Support ticket created successfully!');
    }

    public function show()
    {
        return view("supportTicketInfo");
    }

    public function info(request $request)
    {

        $replies = SupportTicketReply::select('support_ticket_replies.*', 'support_tickets.name as ticket_name', 'support_tickets.email as ticket_email')
        ->join('support_tickets', 'support_ticket_replies.support_ticket_id', '=', 'support_tickets.id')
        ->where('support_tickets.ticketNumber', $request->ticket_number)
        ->get();

        return view('supportTicketInfo_body')
        ->with('replies', $replies);
    }

    public function grid()
    {
        return view('listSupportTickets');
    }

    public function list(Request $request)
    {
        $searchTerm = $request->search_name;

        $tickets = SupportTicket::where('name', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('listSupportTickets_body')
        ->with('tickets', $tickets);
    }

    public function reply($id)
    {
        $ticket = SupportTicket::find($id);
        return view('supportTicketReplyForm')
        ->with('ticketsId', $id)
        ->with('ticket', $ticket);
    }

    public function replySave(Request $request)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        $data['reply_by'] = 1; // Admin
        $data = $request->except('_token');
        SupportTicketReply::create($data);

        $ticket = SupportTicket::find($request->support_ticket_id);
        $ticket->update(['status' => 1]);

        Mail::to($ticket->email)->send(new SupportTicketReplys($ticket->ticketNumber, $request->reply_message));

        return redirect()->route('SupportTicketGrid')->with('success', 'Support ticket Reply Saved successfully!');;
    }

    public function ticketList(request $request)
    {

        $replies = SupportTicketReply::select('support_ticket_replies.*', 'support_tickets.name as ticket_name', 'support_tickets.email as ticket_email')
        ->join('support_tickets', 'support_ticket_replies.support_ticket_id', '=', 'support_tickets.id')
        ->where('support_tickets.ticketNumber', $request->ticket_number)
        ->get();

        return view('supportTicketInfo_body')
        ->with('replies', $replies);
    }

}
