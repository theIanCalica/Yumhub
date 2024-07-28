@extends('customer.layout.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
@endsection

@section('content')
    <div class="container px-8">

        <!-- Foods Grid -->
        <div id="foods-container" class="grid mt-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @foreach ($foods as $food)
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                    <img src="{{ $food->filePath }}" alt="{{ $food->name }}" class="w-full h-48 object-cover rounded-t-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">{{ $food->name }}</h2>
                        <p class="text-gray-600 mb-2 text-sm">{{ $food->category->name }}</p>
                        <p class="text-2xl font-bold text-red-600 mb-4">₱{{ $food->price }}</p>
                        @if (Auth::check())
                            <button data-id="{{ $food->id }}" data-name="{{ $food->name }}"
                                data-category="{{ $food->category->name }}" data-price="{{ $food->price }}"
                                class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                Add to Cart
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    @php
        $user = Auth::user();
    @endphp
    <script>
        $(document).ready(function() {
            $('#foods-container').on('click', '.add-to-cart', function() {
                const id = $(this).data("id");
                let userId = @json($user ? $user->id : null);

                $.ajax({
                    type: "POST",
                    url: "/api/carts",
                    data: {
                        food_ID: id,
                        user_id: userId,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            title: "Yum!😋",
                            text: "You've successfully added a delicious dish to your cart",
                            icon: "success"
                        });
                    }
                });
            });
        });
    </script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

    <!-- Initialize autocomplete menu -->
    <script>
        $('#aa-search-input').on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default autocomplete behavior
                console.log("hi");
            }
        });

        $("#aa-search-input").on("input", function() {
            const cuisine = @json($cuisine);
            const cuisineID = cuisine.id;
            let query = $(this).val();
            $.ajax({
                type: "POST",
                url: "/api/foods-cuisine",
                data: {
                    query: query,
                    cuisine_id: cuisineID,
                },
                datatype: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    $("#foods-container").empty();
                    $.each(data, function(index, food) {
                        // Create HTML structure
                        var foodHtml = `
                            <div class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                                <img src="${food.filePath}" alt="${food.name}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-6">
                                    <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">${food.name}</h2>
                                    <p class="text-gray-600 mb-2 text-sm">${food.category.name}</p>
                                    <p class="text-2xl font-bold text-red-600 mb-4">₱${food.price}</p>
                                    @if (Auth::check())
                                        <button data-id="${food.id}" data-name="${food.name}"
                                            data-category="${food.category.name}" data-price="${food.price}"
                                            class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                            Add to Cart
                                        </button>
                                    @endif
                                </div>
                            </div>
                        `;

                        // Append the generated HTML to the container
                        $('#foods-container').append(foodHtml);
                    });
                }
            });
        });

        var client = algoliasearch('2ZSR07S44R', 'c0f6ac4425126f6ed1595b8aff0e0ca3');
        var foods = client.initIndex('myfoods_index');

        autocomplete('#aa-search-input', {
            debug: true
        }, [{
            source: autocomplete.sources.hits(foods, {
                hitsPerPage: 7
            }),
            displayKey: 'name',
            templates: {
                header: '<div class="aa-suggestions-category">Foods</div>',
                suggestion: function(suggestion) {
                    return '<span>' +
                        suggestion._highlightResult.name.value + '</span><span>' +
                        suggestion._highlightResult.price.value + '</span>';
                },
                empty: '<div class="aa-empty">No matching foods</div>'
            }
        }]);
    </script>
@endsection
