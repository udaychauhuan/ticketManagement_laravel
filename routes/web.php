<?php

use App\Http\Controllers\AddTocartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustommerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\purchasedController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//email verification routes are  placed here -----------------------------

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//The Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resending The Verification Email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Protecting Routes
Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);



//main work start from here--------------------------------------------------------

//redirct to login route
Route::redirect('/', 'login');

//whene a user/admin is autherized than only he/she can access these route-----------------------------
Route::middleware(['auth'])->group(function () {

    // redircting user as per the role
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

    //logout user
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');


    // admin routes------------------------------------------------------------------------------------
    Route::middleware(['AdminRoute'])->group(function () {

        Route::prefix('/admin')->name('Admin.')->group(function () {

            //admin home page
            Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

            //Admin->Ticket Routes--------------------------------------------------------
            Route::get('/View/ticket', [TicketController::class, 'view'])->name('ViewTicket');  //View Ticket
            Route::get('/View/ticket/{id}', [TicketController::class, 'View_one'])->name('ViewOneTicket');  //View one ticket


            Route::get('/create/ticket', [TicketController::class, 'create'])->name('CreateTicket');  //show create ticket page
            Route::post('/create/ticket', [TicketController::class, 'store'])->name('CreateTicket');  //create ticket

            Route::get('/delete/ticket/{id}', [TicketController::class, 'destroy'])->middleware('checkTicket')->name('DeleteTicket'); //Delete Tickets

            Route::get('/Edit/ticket/{id}', [TicketController::class, 'edit'])->middleware('checkTicket')->name('EditTicket');  //show Edit Ticket
            Route::post('/Edit/ticket/{id}', [TicketController::class, 'update'])->middleware('checkTicket')->name('EditTicket');


            //Admin->User routes -----------------------------------------------------------

            Route::get('/View/User', [Usercontroller::class, 'viewUser'])->name('ViewUser');  //View User
            Route::get('/View/User/{id}', [Usercontroller::class, 'showOneUser'])->name('ViewOneUser');  //View one User

            Route::get('/create/user', [Usercontroller::class, 'create'])->name('CreatUser'); //show Create user
            Route::post('/create/user', [Usercontroller::class, 'store'])->name('CreatUser'); // Create user

            Route::get('/delete/user/{id}', [Usercontroller::class, 'destroy'])->middleware('checkUser')->name('DeletetUser'); //delete user

            Route::get('/Edit/user/{id}', [Usercontroller::class, 'edit'])->name('EditUser');  //show Edit user
            Route::post('/Edit/user/{id}', [Usercontroller::class, 'update'])->name('EditUser');  // Edit user

        });
    });

    Route::middleware(['UserRoute'])->group(function () {

        Route::prefix('user')->name('User.')->group(function () {
            Route::get('/dashboard', [HomeController::class, 'Home_Page'])->name('home');  


            //add to cart------------------------------------------------------------
            Route::get('/addtocart/add/{id}/{qu?}', [AddTocartController::class, 'store'])->name('AddToCart'); //add to cart ,here we can add ticket from the user panel and cart list also
            Route::get('/addtocart/remove/{id}', [AddTocartController::class, 'destroy'])->name('RemoveToCart'); //remove from card itesm

            // user routes ---------------------------------------------------------

            Route::get('/cart', [CustommerController::class, 'index'])->name('index'); //user home

            Route::post('/purchase', [PurchasedController::class, 'purchased'])->name('purchase'); //user purchase
            Route::get('/purchase/{id}', [PurchasedController::class, 'removePurchase'])->name('removePurchase'); // remove item from purchase
            Route::get('/removeAll', [purchasedController::class, 'clearAll'])->name('clearAll'); //clear al the cart list

            Route::get('/purchased/{id}', [PurchasedController::class, 'purchased_history'])->name('purchase_history'); //user purchase history

            Route::get('/ownedTicket', [CustommerController::class, 'viewTicket'])->name('ViewTicket'); //show user creted ticket

            Route::get('/ownedTicket/create', [CustommerController::class, 'createTicket'])->name('CreateTicket'); //store tickete
            Route::post('/ownedTicket/create', [CustommerController::class, 'storeTicket'])->name('CreateTicket');

            Route::get('/ownedTicket/Edit/{id}', [CustommerController::class, 'edit'])->middleware('checkTicket')->name('EditTicket');
            Route::post('/ownedTicket/Edit/{id}', [CustommerController::class, 'update'])->middleware('checkTicket')->name('EditTicket'); // edit user created ticket

            Route::get('/ownedTicket/delete/{id}', [CustommerController::class, 'destroy'])->middleware('checkTicket')->name('DeleteTicket'); //delete ticket from user side

            Route::get('/ownedTicket/sold', [CustommerController::class, 'soldTicket'])->name('SoldTicket'); //list of user's sold ticke created by user 
            
            Route::get('/notify/mark/{id}',[CustommerController::class, 'markAsread'])->name('markAsRead'); //make notification readed and redirect to sold ticket page

        });
    });
});



