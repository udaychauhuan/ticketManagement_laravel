<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\AddToCart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    // firstly we show all cart item when user had added some ticket on the cart
    public function Home_Page()
    {
        //get the tickets on the behalf of add to cart orderby id in 'desc' order
        $cartItem = AddToCart::whereUser_id(auth()->user()->id)->with('ticket')->orderBy('id', 'desc')->get();

        //geting all ticket list
        $tickets = Ticket::Paginate(6);

        return view('index', compact('tickets', 'cartItem'));
    }

    //here we have checked if the user is admin that redirect it to admin dashborad otherwise user dashborad
    public function redirect()
    {
        if (Auth::user()->UserType == 1) {

            return redirect()->route('Admin.index');

        } else if (Auth::user()->UserType == 0) {

            return redirect()->route('User.home');

        }
    }
}
