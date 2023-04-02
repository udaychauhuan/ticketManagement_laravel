<?php

namespace App\Http\Controllers;

use App\Events\RegisterUserEvent;
use App\Rules\phonerul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Event;

class Usercontroller extends Controller
{

    /**
     * Display a listing of the all user in view user of admin
     */
    public function viewUser()
    {
        //select all user from the users tables
        $users = User::all();

        return view('admindashboard.component.User.View_user', compact('users'));
    }


    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admindashboard.component.user.create_user');
    }

    /*
     * Store a newly created new user
     */
    public function store(Request $request)
    {

        //applying the validaition
        $request->validate([
            'UserName' => 'required|string',
            'UserPhone' => [
                //here we are apply the phone rule to check the minimum length of phone no  is 10
                'required', 'numeric', new phonerul()
            ],
            'Useremail' => 'Required|email|unique:Users,email',
            'Password' => 'required|min:8',
            'UserType' => 'required|numeric',
        ]);

        //it the user input pass all the valiadation than store it in the user table
         User::create([
            'name' => $request->UserName,
            'email' => $request->Useremail,
            'phone' => $request->UserPhone,
            //saving the password in the hashformate
            'password' => Hash::make($request->Password),
            'UserType'=> $request->UserType,
        ]);

        // calling an event when user is created send him/her a mail with user and password
       // Event::dispatch(new RegisterUserEvent($user->id ,$request->Password));

        return redirect()->route('Admin.ViewUser')->with(['status' => 'success', 'message' => 'User created successfully']);
    }

    /**
     * Display the specified user in admin dashboard
     */
    public function showOneUser(string $id)
    {
        //finding the specific user
        $user = User::find($id);

        return view('admindashboard.component.user.view_one_user',compact('user'));
    }

    /**
     * Show the form for editing the user by admin
     */
    public function edit(string $id)
    {
        //finding the specific user to display the edit page
        $user = User::find($id);

        return view('admindashboard.component.User.Edit_user',compact('user'));
    }



    /**
     * Update the specified user by the admin side
     */
    public function update(Request $request,  $id)
    {

         /**here we are apply the validation on the user email if the admin want to edit he user email the it check the
         user can have unique email or can have the same email
          */
        $request->validate([
            'Useremail' => 'required|email|unique:users,email,'.$id,
            'UserPhone' => [
                          //here we are apply the phone rule to check the minimum length of phone no  is 10
                            'required', 'numeric', new phonerul()
            ],
        ]);

        //if the user input field pass the validation update the informatio
         User::whereId($id)->update([
            'name' => $request->UserName,
            'email' => $request->Useremail,
            'phone' => $request->UserPhone,
            'UserType'=> $request->UserType,
        ]);

        return redirect()->route('Admin.ViewUser')->with(['status' => 'success', 'message' => 'User updated successfully']);

    }


    /**
     * Remove the specified user
     */
    public function destroy(string $id)
    {
        //finding the user and delete
        User::find($id)->delete();

        return redirect()->route('Admin.ViewUser')->with(['status' => 'success', 'message' => 'User Deleted successfully']);
    }
}
