<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
   


    public function index(Evenement $Evenement)
    {
        
        $event=$Evenement->load('reservations.user');

        
        // Eager load reservations and associated user
        return view('evenement.reservants', compact('event'));
    }

    

    public function confirmEvent($eventId)
    {
       
        $Reservation = Reservation::findOrFail($eventId);

ddd($Reservation);
        $Reservation->status='validé';
     $Reservation->save();
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Événement confirmé avec succès.');
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
  
     public function store(Request $request, Evenement $Evenement )
     {
         $event = Evenement::findOrFail($Evenement->id);
         if ($event->available_places <= 0) {
            return redirect()->back()->with('error', 'Désolé, il n\'y a plus de places disponibles pour cet événement.');
        }else{
            $reservation = new Reservation();
      if($event->type_of_reservation === 'Automatique'){
        $event->available_places -= $request->ticket_number;
      
        $reservation->status='validé';
      }

         $reservation->event_id = $event->id;
         $reservation->user_id = Auth::id();
         $reservation->ticket_number =$request->ticket_number;
         $reservation->save();
 
         // Met à jour le nombre de places disponibles pour l'événement
         
         $event->save();
         if($event->type_of_reservation === 'Automatique'){
         return redirect()->back()->with('success', 'Votre réservation a été enregistrée avec succès.');
        }else if($event->type_of_reservation === 'par_confirmation'){
            return redirect()->back()->with('success', 'Votre réservation a été enregistrée avec succès et en cours de traitement pour télecharger vos ticket .');
        }}
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
