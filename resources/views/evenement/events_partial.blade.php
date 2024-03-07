  @foreach ($events as $event)
      <div class=" flex items-center justify-center m-3 px-8 entreprise-card" data-nom="{{ $event->title }}">
          <div class="flex flex-col w-full bg-white rounded shadow-lg sm:w-3/4 md:w-1/2 lg:w-3/5">
              <div class="w-full h-64 bg-top bg-cover rounded-t"
                  style="background-image: url({{ asset('storage/' . $event->image) }})"></div>
              <div class="flex flex-col w-full md:flex-row">
                  <div
                      class="flex flex-row justify-around p-4 font-bold leading-none text-gray-800 uppercase bg-gray-400 rounded md:flex-col md:items-center md:justify-center md:w-1/4">
                      <div class="md:text-3xl">{{ date('M', strtotime($event->date)) }}</div>
                      <div class="md:text-6xl">{{ date('j', strtotime($event->date)) }}</div>

                  </div>
                  <div class="p-4 font-normal text-gray-800 md:w-3/4">
                      <div class="flex justify-between items-center ">
                          <h1 class="mb-4 text-4xl font-bold leading-none tracking-tight text-gray-800">
                              {{ $event->title }} </h1>
                              <h6 class=""> (   {{ $event->category->name }}) </h6>

                           
                          @if ($event->Status == 'not_confirmed_yet')
                              <p class="flex justify-center items-center text-red-500">Not confirmed yet
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4"
                                      viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                      <path fill="#ff3300"
                                          d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                  </svg>
                              </p>
                          @else
                              <p class="flex justify-center items-center text-green-500">Confirmed
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4"
                                      viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                      <path fill="#4dff00"
                                          d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                  </svg>
                              </p>
                          @endif

                      </div>
                      <p class="leading-normal">{{ $event->description }}</p>
                      <div class="flex flex-row border-t border-indigo-500 items-center mt-4 text-gray-700">
                        
                          @if (auth()->user()->role === 'utilisateur')
                              <form action="{{ route('Reservation.store', ['Evenement' => $event->id]) }} "class="flex items-center hover:bg-blue-500 bg-gray-300"
                                  method="POST">
                                  @csrf
                                  <input type="number" name="ticket_number" class="border border-gray-500 w-16 h-fit m-2 " min="1" placeholder="0"  >
                                  <button type="submit" 
                                      class="flex items-center justify-center w-full  m-4 font-medium text-black  rounded ">
                                      Reserve Your Place
                                      <img src="{{ asset('storage/images/reserve.png') }}" class="w-12 m-2"
                                          alt="reservation">
                                  </button>
                              </form>
                          @elseif (auth()->user()->role === 'organisateur' && $event->type_of_reservation === 'par_confirmation')
                              <form action="{{ route('Reservants', ['Evenement' => $event->id]) }}" method="POST">
                                  @csrf
                                  <button
                                      class="flex  items-center justify-center w-full  mt-4 font-medium text-black  rounded hover:bg-blue-500">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-12" viewBox="0 0 640 512">
                                          <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                          <path
                                              d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                                      </svg>

                                      CONFIRM YOUR RESERVATIONS</button>

                              </form>
                          @endif

                          <div class="w-1/2 m-2 flex">
                            <form action="{{ route('Evenement.details', ['Evenement' => $event]) }}" method="POST">
                                @csrf

                                <button>See More</button>

                            </form>
                          </div>

                          <div class="w-1/2  flex justify-end">

                              <form action="{{ route('evenement.edit', ['evenement' => $event->id]) }}" method="GET" class="m-2">
                                  @csrf
                                  <button type="submit" class="text-blue-500">Update Event</button>
                              </form>
                              <form class="m-2" action="{{ route('evenement.destroy', ['evenement' => $event->id]) }}"
                                  method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-red-500">Delete Event</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  @endforeach


  <div class="mt-4">
      {{ $events->links() }}
  </div>


  