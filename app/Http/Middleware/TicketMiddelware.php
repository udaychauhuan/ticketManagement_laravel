<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\AddTocart;
use App\Models\purchased;

class TicketMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,): Response
    {
        //here we have check tha if the ticket id is exist in the purchase table the redirect to same page with message
        $Ticket = purchased::whereTicket_id($request->id)->get();

        if (($Ticket->count()>0)) {
            
            //redirect the user with the specific user route
           if (auth()->user()->UserType == 1) {
            return redirect()->route('Admin.ViewTicket')->with(['status' => 'failed', 'message' => 'Ticket Cant be Deleted or Modified !!.']);
           } else {
            return redirect()->route('User.ViewTicket')->with(['status' => 'failed', 'message' => 'Ticket Cant be Deleted or Modified !!.']);
           }


        }
        return $next($request);
    }
}
