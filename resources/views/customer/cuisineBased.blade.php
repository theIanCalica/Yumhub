@extends('customer.layout.app')

@section('styles')
    <!-- Algolia InstantSearch CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7/themes/algolia-min.css">
@endsection

@section('content')
    <div class="container mx-auto py-8 px-8">
        <!-- Search Bar -->
        <div class="flex justify-center mb-8">
            <input type="text" id="search-bar" placeholder="Search for foods..."
                class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500" />
        </div>

        <!-- Foods Grid -->
        <div id="foods-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @foreach ($foods as $food)
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                    <img src="{{ $food->filePath }}" alt="{{ $food->name }}"
                        class="w-full h-48 object-cover rounded-t-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">{{ $food->name }}</h2>
                        <p class="text-gray-600 mb-2 text-sm">{{ $food->category->name }}</p>
                        <p class="text-2xl font-bold text-red-600 mb-4">₱{{ $food->price }}</p>
                        <button data-id="{{ $food->id }}" data-name="{{ $food->name }}"
                            data-category="{{ $food->category->name }}" data-price="{{ $food->price }}"
                            class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                            Add to Cart
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <!-- Algolia InstantSearch JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
    <script>
        const search = instantsearch({
            indexName: 'foods',
            searchClient: algoliasearch('2ZSR07S44R', 'f6883efda15a6fa9e04586d44cbfcd5e'),
        });

        // Add search box
        search.addWidget(
            instantsearch.widgets.searchBox({
                container: '#search-bar',
                placeholder: 'Search for foods...',
            })
        );

        // Add hits display
        search.addWidget(
            instantsearch.widgets.hits({
                container: '#foods-container',
                templates: {
                    item: `
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                <img src="{{ attributes . ilePath }}" alt="{{ attributes . name }}" class="w-full h-48 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">{{ attributes . name }}</h2>
                    <p class="text-gray-600 mb-2 text-sm">{{ attributes . category }}</p>
                    <p class="text-2xl font-bold text-red-600 mb-4">₱{{ attributes . price }}</p>
                    <button data-id="{{ objectID }}" data-name="{{ attributes . name }}"
                        data-category="{{ attributes . category }}" data-price="{{ attributes . price }}"
                        class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        Add to Cart
                    </button>
                </div>
            </div>
            `,
                },
            })
        );

        // Start the search instance
        search.start();

        // Handle add-to-cart functionality
        $(document).on('click', '.add-to-cart', function() {

        });
    </script>
@endsection
