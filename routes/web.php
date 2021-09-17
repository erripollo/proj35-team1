<?php

use Illuminate\Support\Facades\Route;
use App\Apartment;
use App\Http\Resources\ApartmentResource;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //$now = Carbon::now()->setTimeZone("Europe/Rome");
    $sponsoredApartment = ApartmentResource::collection(Apartment::with(['services'])
        ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
       // ->where('end', '>', $now)
        ->where('visible', true)
        ->paginate(4));
    return view('guest.welcome', compact('sponsoredApartment'));
})->name('home');

/* view apartment and send messages */
Route::get('guest/apartment/{apartment}', 'SearchController@show')->name('guest.apartment.show');
Route::post('message/{apartment}', 'SearchController@send')->name('send.message');


Auth::routes();

/* Admin routes */

Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('apartments', ApartmentController::class);
    Route::resource('messages', MessageController::class);
    Route::get('/stats/{apartment}', 'HomeController@stats')->name('stats');
    // Payment
    Route::get('sponsors/{apartment}', 'SponsorController@buySponsorship')->name('buySponsorship');
    Route::post('checkout/{apartment}', 'PaymentController@checkout')->name('checkout');
});


/* Guest routes */

Route::get('house', 'SearchController@index')->name('house');
