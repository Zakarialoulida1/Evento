<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEvenementRequest;
use App\Http\Requests\EvenementRequest;
use App\Models\Categorie;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{

    public function show(){

        $events = Evenement::with('category')->paginate(2);

        return view('evenement.show',compact('events'));
    }
    public function edit(){

        $categories=Categorie::all();
        return view('evenement.edit',compact('categories'));
    }
 
    

    public function store(EvenementRequest $request)
{
    // Check if the request has an image file
    if ($request->hasFile('image')) {
        // Store the image in the storage and get the image path
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        // Set a default image path if no image is uploaded
        $imagePath = 'images/default.jpg';
    }

    // Merge the image path and the authenticated user's ID into the validated data
    $validatedData = array_merge($request->validated(), [
        'image' => $imagePath,
        'user_id' => auth()->id(),
    ]);

    // Create the event
    Evenement::create($validatedData);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Evenement created successfully.');
}
public function details(Evenement $Evenement)
{
    
   $event= $Evenement->load('category', 'organizer');

    return view('evenement.details', compact('event'));
}

public function destroy(Evenement $evenement)
{
    $evenement->delete();

    return redirect()->back()->with('success', 'Event deleted successfully.');
}

}
