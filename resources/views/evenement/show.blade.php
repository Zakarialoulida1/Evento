<x-app-layout>
    <!-- Display success message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Display error message -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- <form action="" method="GET">
        <label for="category" class="mr-2">Filter by Category:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>
    <!-- Category Filter Dropdown --> --}}
    <label for="category" class="mr-2">Filter by Category:</label>
    <select name="category" id="category">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <input type="text" id="searchInput" placeholder="Recherche...">
    <div id="searchResults"></div>
    
  

<h1>Filter</h1>
    <div id="events-list" >
        @include('evenement.events_partial', ['events' => $events])
    </div>



    <script>



document.getElementById('searchInput').addEventListener('input', function() {
          var searchTerm = this.value.trim().toLowerCase();
          var entrepriseCards = document.querySelectorAll('.entreprise-card');

          entrepriseCards.forEach(function(card) {
              var nom = card.getAttribute('data-nom').toLowerCase();
              if (nom.includes(searchTerm)) {
                  card.style.display = 'block';
              } else {
                  card.style.display = 'none';
              }
          });
      });

document.getElementById('category').addEventListener('change', function() {
    var categoryId = this.value;

    // Send Ajax request to server
    axios.get('/events/filter', {
        params: {
            category_id: categoryId
        }
    })
    .then(function(response) {
        // Update events list with filtered events
        document.getElementById('events-list').innerHTML = response.data;

        // Update pagination links with category filter
        var paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(function(link) {
            var href = link.getAttribute('href');
            link.setAttribute('href', href + (href.includes('?') ? '&' : '?') + 'category=' + categoryId);
        });
    })
    .catch(function(error) {
        console.error('Error fetching filtered events:', error);
    });
});

    </script>
</x-app-layout>
