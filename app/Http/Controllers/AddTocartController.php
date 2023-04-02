<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Ticket;
use App\Models\User;

class AddTocartController extends Controller
{

    // when user click on add to cart, storing the Ticket details on add to cart of that user
    public function store($id, $qu = null)
    {
        //To check whether quantity is present or not
        $flag = 0;

        //to get the icket details
        $ticket = Ticket::find($id);

        //by default quantity is 1
        $quantity = 1;

        //getting only those items which are added by specific user in to carts
        $items = User::find(auth()->user()->id)->addtocart()->get();

        //we have check here if the same ticket is present than only increase the quantity
        foreach ($items as $item) {
            if ($item->ticket_id == $ticket->id) {
                if ($qu != null) {
                    $quantity = $qu;
                    $flag = 1;
                } else {
                    $quantity = $item->Quentity;
                    $quantity++;
                    $flag = 0;
                }
            }
        }

        // if ticket is present than update it otherwise create new cart Item
        User::find(auth()->user()->id)->addtocart()->updateOrCreate(
            ['ticket_id' => $ticket->id],
            [
                'user_id' => auth()->user()->id,
                'Quentity' => $quantity,

            ]
        );

        if ($flag == 1) {
            return true;
        }
        //redirecting to home route with success message
        return redirect()->route('User.home')->with(['status' => 'success', 'message' => 'Ticket added to cart, successfully']);
    }


    //remove from addToCart
    public function destroy($id)
    {
        //same as addto cart, here we have check if quanitiy is greater  than 1  than it decrease it  otherwise delete it
        $user = User::find(auth()->user()->id);

        //finding the specific items to remove
        $removeItem = AddToCart::find($id);

        //here we have insert the the quantity of remove item into qnanity veriable
        $quantity = $removeItem->Quentity;

        //checking if the quantity is greater than 1
        if ($removeItem->Quentity > 1) {

            //decrease the quantity
            $quantity--;

            //and update it
            $user->addtocart()->whereId($removeItem->id)->update([
                'ticket_id' => $removeItem->ticket_id,
                'Quentity' => $quantity,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            //if quantity is equal to 1 than remove it
            $removeItem->delete();
        }

        //redirect to home page with success massage
        return redirect()->route('User.home')->with(['status' => 'success', 'message' => 'Ticket remove from cart, successfully']);
    }
}
