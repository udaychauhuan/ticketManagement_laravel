<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Purchased;

class CustommerController extends Controller
{

    /**
     * in user home page  show the carts items
     */
    public function index()
    {
        ///remove all addtocart ticket which have quantity '0'
        AddToCart::whereQuentity(0)->delete(); 

        //getting the list of items which having the same id as auth user in orderby id in 'desc order .
        $items = AddToCart::whereUser_id(auth()->user()->id)->with('ticket')->orderBy('id', 'desc')->paginate(6);

        return view('UserPanel.components.purchase_list', compact('items'));
    }

    /**
     * here we only show those tickets which are created by user
     */

    public function viewTicket()
    {
        //get those ticket which are created by user
        $ticket = Ticket::whereHas('user', function ($q) {
            $q->where('User_id', '=', auth()->user()->id);
        })->get();

        return view('UserPanel.components.Ticket.view_ticket', compact('ticket'));
    }

    /**
     * Display the user's ticket create page
     */

    public function createTicket(Request $request)
    {
        return view('UserPanel.components.Ticket.create_ticket');
    }

    /**
     *  Store a newly created ticket by user's side
     */
    public function storeTicket(Request $request)
    {
        ///here we apply the valiadition on coming request fields
        $request->validate([
            'TicketName' => 'required',
            'Ticketprice' => 'required|numeric',
            'TicketDiscription' => 'required',
        ], [
            //how it respond to user website when such error is occure
            'Ticketprice.require' => 'Please Enter amount of ticket.',
            'Ticketprice.numeric' => ' Amount should be numeric value. ',
        ]);


        $user = User::find(Auth::user()->id);

        //create ticket
        $user->ticket()->create([
            'TicketName'  => $request->TicketName,
            'TicketPrice' => $request->Ticketprice,
            'TicketDiscription' => $request->TicketDiscription,
        ]);

        return redirect()->route('User.ViewTicket')
            ->with(['status' => 'success', 'message' => 'Ticket created successfully']);
    }

    /**
     * Show the form for editing the tickets from user's side
     */
    public function edit(string $id)
    {
        //getting the list of tickets
        $ticket = Ticket::find($id);

        return view('UserPanel.components.Ticket.edit_ticket', compact('ticket'));
    }

    /**
     * Update the tickets from user's side page
     */
    public function update(Request $request, string $id)
    {

        $user = User::find(Auth::user()->id);

        //update the tickets details from the user(admin)
        $user->ticket()->whereId($id)->update([
            'TicketName'  => $request->TicketName,
            'TicketPrice' => $request->Ticketprice,
            'TicketDiscription' => $request->TicketDiscription,
        ]);

        return redirect()->route('User.ViewTicket')
            ->with(['status' => 'success', 'message' => 'Ticket updated successfully']);
    }

    /**
     * Remove the specified ticket from user side
     */
    public function destroy(string $id)
    {
        $user = User::find(Auth::user()->id);

        //deleting the specific ticket created by user
        $user->ticket()->whereId($id)->delete();

        return redirect()->route('User.ViewTicket')
            ->with(['status' => 'success', 'message' => 'Ticket deleted successfully']);
    }

    /**
     * displya the list of those ticket which are created by user and buyed by othre user
     */
    public function soldTicket()
    {
        //get the id of ony auth user's created ticket
        $ticketId = Ticket::where('user_id', '=', auth()->user()->id)->pluck('id');

        //cheking that if the ticket_id is present in purchased ticket table
        $tickets = Purchased::whereIn('ticket_id', $ticketId)->orderby('id','desc')->get() ;

        return view('UserPanel.components.Ticket.sold_ticket', compact('tickets'));
    }


    //when user check thier notification and try to read  than make that notification as readed
    // and redirect to the soldticket page
    public function markAsread($id)
    {
        if ($id) {

            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return redirect()->route('User.SoldTicket');
    }
}
