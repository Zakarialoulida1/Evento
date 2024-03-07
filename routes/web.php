<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::get('/Evenements',[EvenementController::class,'show'])->name('Evenement.show');
    Route::post('/Evenement/{Evenement}', [EvenementController::class, 'details'])->name('Evenement.details');

   Route::get('/events/filter',  [EvenementController::class, 'filterByCategory'])->name('events.filter');
    Route::get('/search', [EvenementController::class, 'search'])->name('entreprise.search');

    Route::post('/Reservation/{Evenement}', [ReservationController::class, 'store'])->name('Reservation.store');
 
    
});


Route::post('/Reservation/confirm/{Evenement}', [ReservationController::class, 'index'])->name('Reservants');

Route::middleware([ 'role:organisateur'])->group(function () {
    Route::get('/Evenement',[EvenementController::class,'create'])->name('Evenement.create');
    Route::post('/Evenement',[EvenementController::class,'store'])->name('Evenement.store');
    Route::delete('/Evenement/{evenement}', [EvenementController::class, 'destroy'])->name('evenement.destroy');
    Route::get('/evenement/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenement.edit');
    Route::put('/evenement/{evenement}', [EvenementController::class, 'update'])->name('evenement.update');
  
Route::put('/admin/confirm-event/{eventId}', [ReservationController::class, 'confirmEvent'])->name('confirmEvent');

 
});

require __DIR__.'/auth.php';
