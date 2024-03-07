<x-app-layout>

<!-- Add this after the form -->
@if($event->reservations->count() > 0)
    <div class="mt-8">
        <h2 class="text-lg font-semibold mb-4">List of Reservations</h2>
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de ticket </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                   
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($event->reservations as $reservation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">      <div class=" w-[35px]">
                            <img class="rounded-full" src="{{ asset('storage/' . $reservation->user->image) }}" alt="">
                        </div>
                       </td>
                       
                        <td class="px-6 py-4 whitespace-nowrap ">{{ $reservation->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $reservation->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $reservation->ticket_number}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation}}




                            <form action="{{ route('confirmEvent', ['eventId' => $reservation->id]) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Ajoutez cette ligne pour spécifier la méthode PUT -->
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Confirmer
                                </button>
                            </form>
                      
                        </td>
                        
                        
                       
                        <!-- Add more columns if needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="mt-8">No reservations have been made for this event yet.</p>
@endif

    
</x-app-layout>