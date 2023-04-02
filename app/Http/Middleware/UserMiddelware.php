<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AddTocart;
use App\Models\purchased;

class UserMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     //here we have check tha if the user id is exist in the purchase table the redirect to same page with message
    public function handle(Request $request, Closure $next): Response
    {
        $user = purchased::whereUser_id($request->id)->get();
        
        if (($user->count()>0)) {
           return redirect()->route('Admin.ViewUser')->with(['status' => 'failed', 'message' => 'User Cant be Deleted !!.']);
        }
        return $next($request);
    }
}
