<?php

namespace App\Http\Controllers;


use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of ticket in admin  view tickets.
     */
    public function view()
    {
        //storing the auth user id in id veriable
        $id = Auth::user()->id;

        //getting the list of ticket from ticket table
        $tickets = Ticket::whereUser_id($id)->get();

        return view('admindashboard.component.Ticket.View_ticket',compact('tickets'));
    }

    /**
     * Display a only one  ticket cretaed by user in user(admin) view tickets.
     */
    public function View_one($id)
    {
        //getting the list of ticket from ticket table
        $ticket = Ticket::find($id);

        return view('admindashboard.component.Ticket.view_one_ticket',compact('ticket'));
    }

    /**
     * Show the form for creating a new ticket in admin's side
     */
    public function create(Request $request)
    {
        return view('admindashboard.component.Ticket.create_ticket');
    }

    /*
     * Store a newly created tickets by admin
     */
    public function store(Request $request)
    {

        //apply the validation on tickets
        $request->validate([
            'TicketName' => 'required',
            'Ticketprice' => 'required|numeric',
            'TicketDiscription' => 'required',
        ], [
            'Ticketprice.require' => 'Please Enter amount of ticket.',
            'Ticketprice.numeric'=> ' Amount should be numeric value. ',
        ]);

        $user = User::find(Auth::user()->id);

        //creating the ticket bby admin
        $user->ticket()->create([
            'TicketName'  => $request->TicketName,
            'TicketPrice' => $request->Ticketprice,
            'TicketDiscription' => $request->TicketDiscription,
        ]);

        return redirect()->route('Admin.ViewTicket')->with(['status' => 'success', 'message' => 'Ticket created successfully']);
    }


    /**
     * Show the form for editing the Edit tickets in admin side
     */
    public function edit($id)
    {
        //finding the ticket which we want to edit
        $Ticket = Ticket::find($id);

        return view('admindashboard.component.Ticket.Edit_ticket',compact('Ticket'));
    }

    /**
     * Update the specified  ticket by admin
     */
    public function update(Request $request,$id)
    {

        $user = User::find(Auth::user()->id);

         //updating the ticket by auth user
        $user->ticket()->whereId($id)->update([
            'TicketName'  => $request->TicketName,
            'TicketPrice' => $request->Ticketprice,
            'TicketDiscription' => $request->TicketDiscription,
        ]);

        return redirect()->route('Admin.ViewTicket')->with(['status' => 'success', 'message' => 'Ticket updated successfully']);
    }

    /**
     * Remove the specified ticket by admin.
     */
    public function destroy($id)
    {

       $user = User::find(Auth::user()->id);
       
      //remove the ticket  by admin
       $user->ticket()->whereId($id)->delete();

       return redirect()->route('Admin.ViewTicket')->with(['status' => 'success', 'message' => 'Ticket Deleted successfully']);
    }

}
