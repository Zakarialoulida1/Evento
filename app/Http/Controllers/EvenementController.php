<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEvenementRequest;
use App\Http\Requests\EvenementRequest;
use App\Models\Categorie;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EvenementController extends Controller
{
    public function show(Request $request){

        $categories=Categorie::all();
     $categoryId = $request->input('category');

     
    if ($categoryId) {
        $events = Evenement::where('categorie_id', $categoryId)->with('category')->paginate(2);
    } else {
        $events = Evenement::with('category')->paginate(2);
    }
        return view('evenement.show',compact('events','categories'));
        
    }
    public function create(){

        $categories=Categorie::all();
        return view('evenement.create',compact('categories'));
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

public function edit(Evenement $evenement)
{
    $evenement= $evenement->load('category');
   
   
    $categories = Categorie::all();
    return view('evenement.edit', compact('evenement', 'categories'));

}

public function update(EvenementRequest $request, Evenement $evenement)
{
    // Validate the request data
    $request->validated();

    // Handle image upload and deletion
    if ($request->hasFile('image')) {
       
        Storage::delete('public/' . $evenement->image);

        $imagePath = $request->file('image')->store('images', 'public');
    } else {
       
        $imagePath = $evenement->image;
    }

    // Merge the image path into the request data
    $requestData = array_merge($request->all(), ['image' => $imagePath]);

    // Update the event with the new data
    $evenement->update($requestData);

    // Redirect to the event details page with a success message
    return redirect()->route('Evenement.show')->with('success', 'Event updated successfully.');
}


public function filterByCategory(Request $request)
{
 
    $categoryId = $request->input('category_id');
 if(  $categoryId){
    $events = Evenement::where('categorie_id', $categoryId)->with('category')->paginate(2);
 }else{
    $events = Evenement::with('category')->paginate(2);
 }
     $events->setPath('/Evenements');
    // Return filtered events partial view
    return view('evenement.events_partial', compact('events'));
}


public function search(Request $request)
{
    $searchTerm = $request->input('searchTerm');

    $events = Evenement::where('title', 'LIKE', "%{$searchTerm}%")->get();

    return response()->json($events);
}

}
