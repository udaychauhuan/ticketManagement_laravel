<?php

namespace App\Http\Controllers;

use App\Models\Purchased;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of tickets.
     */
    public function index()
    {
        // to get ticket list
        $ticket = Ticket::all();

        //to get purchase list
        $purchased  = Purchased::all();

        // to get the only items which are purchased by user in desc order
        $userPurchased = Purchased::with('ticket')->orderby('id','desc')->paginate(8); 

        return view('admindashboard.admin_index', compact('ticket', 'purchased', 'userPurchased'));
    }

    /**
     * logout the user manualy
     */
    public function logout()
    {
        //remove the session
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
