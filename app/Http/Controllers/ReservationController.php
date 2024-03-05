<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  
     public function store(Evenement $Evenement )
     {
         $event = Evenement::findOrFail($Evenement->id);
 
      if($event->type_of_reservation === 'Automatique'){
        $event->available_places -= 1;
      }
      
         if ($event->available_places <= 0) {
             return redirect()->back()->with('error', 'Désolé, il n\'y a plus de places disponibles pour cet événement.');
         }
 
 
         $reservation = new Reservation();
         $reservation->event_id = $event->id;
         $reservation->user_id = Auth::id();
         $reservation->save();
 
         // Met à jour le nombre de places disponibles pour l'événement
         
         $event->save();
 
         return redirect()->back()->with('success', 'Votre réservation a été enregistrée avec succès.');
     }
 

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
