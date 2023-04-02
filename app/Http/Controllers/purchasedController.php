<?php

namespace App\Http\Controllers;

use App\Events\TicketPurchasedEvent;
use App\Models\AddTocart;
use App\Models\Purchased;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Models\Ticket;
use App\Notifications\TicketSoldNotification;

class PurchasedController extends Controller
{

    //when user purchase ticket from cart list
    public function purchased(Request $request)
    {
        try {
            //convert all request in to array
            $data[] = $request->all();

            //for multiple purchased of tickets by user at  same time
            for ($i = 0; $i < count($data[0]['ticketId']); $i++) {

                //getting the cart items which having the relation with ticket table
                $items =  AddTocart::whereId($data[0]['cartId'][$i])->with('ticket')->firstorfail();

                //getting the total  price of the ticket
                $totalPrice = ((int)($data[0]['quantity'][$i]) * ($items->ticket->TicketPrice));

                //here we find the auth user and create a purchased ticket
                $ticket = User::find(Auth::user()->id)->purchased()->create([
                    'Ticket_id' => $data[0]['ticketId'][$i],
                    'quantity' => $data[0]['quantity'][$i],
                    'totalPrice' => $totalPrice,
                    'user_id' => auth()->user()->id,
                ]);

               
                //send the notification to the owner about thier ticket is sold
                $this->sendNotification($ticket);

                //if ticket is purchased than those cart item is deleted
                if ($ticket) {
                    $items->delete();
                }


                //when a user is purchased any ticket he/sher will recived an email 
                //Event::dispatch(new TicketPurchasedEvent(auth()->user()->id, $data[0]['ticketId'][$i]));
            }
        } catch (\Throwable $th) {
            //if any error is occure than redirect to the previous page with message
            return redirect()->back()->with(['status' => 'failed', 'message' => 'Please select the ticket to purchased !!.']);
        }

        return redirect()->route('User.index')->with(['status' => 'success', 'message' => 'Ticket hase been purchased successfully.']);
    }

    /**
     *if user want to remove the cart item from the Cart List
     */
    public function removePurchase($id)
    {
        //selecting the cart Ticket owned by the auth user and delet it.
        Auth::user()->addtocart()->whereId($id)->delete();

        return redirect()->route('User.index')->with(['status' => 'success', 'message' => 'Ticket removed from cart, successfully.']);
    }


    /**
     *clear all the cart items by user
     */
    public function clearAll()
    {
        //insert all user cart items in the items variable 
        $items =  Auth::user()->addtocart()->whereUser_id(auth()->user()->id);

        //we have check  that if their is any item in the cart list
        if ($items->count() < 1) {

            //if cart is empty than redirect back with message
            return redirect()->back()->with(['status' => 'failed', 'message' => 'Cart is empty !!.']);
        } else {

            //selecting the all cart Ticket owned by the auth user and delet it.
            Auth::user()->addtocart()->whereUser_id(auth()->user()->id)->delete();
        }

        return redirect()->route('User.index')->with(['status' => 'success', 'message' => 'Remove all tickets ,successfully.']);
    }


    //when user had purchased some tickets
    public function purchased_history($id)
    {
        //select the ticket from purchased list behalf of the specific user
        $purchased = Purchased::whereUser_id(auth()->user()->id)->with('ticket')->get();

        return view('UserPanel.components.purchased', compact('purchased'));
    }

    //this method is notify the owner when the other user buy his/her  ticket
    public function sendNotification($ticket)
    {
         //getting the detail of purchaed ticket
         $ticket1 = Ticket::find($ticket->Ticket_id);

         //getting the details of purchased user
         $purchasUser = User::find($ticket->user_id); 

         //getting the details of owner of that ticket
         $owner =  User::find($ticket1->User_id);
         
         //here he have notify the owner
         $owner->notify(new TicketSoldNotification($purchasUser,$ticket1));
    }
}
