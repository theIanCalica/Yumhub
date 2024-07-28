@extends('customer.layout.app')

@php

    $user = Auth::user();

@endphp

@section('styles')
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
@endsection
@section('content')
    <div class="container mx-auto py-8 px-8">
        <!-- Search Bar -->
        <div class="flex justify-center">
            <div class="aa-input-container" id="aa-input-container">
                <form method="POST">
                    <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search for food"
                        name="search" autocomplete="off" />
                    <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                        <path
                            d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                    </svg>
                </form>
            </div>
        </div>

        <!-- Filters -->
        <div class="flex flex-col md:flex-row mb-8 gap-6">
            <!-- Category Filter -->
            <div class="flex-1">
                <label for="category-filter" class="block text-gray-700 mb-2">Category</label>
                <select id="category-filter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="" selected disabled>All Categories</option>

                </select>
            </div>

            <!-- Cuisine Filter -->
            <div class="flex-1">
                <label for="cuisine-filter" class="block text-gray-700 mb-2">Cuisine</label>
                <select id="cuisine-filter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="" selected disabled>All Cuisines</option>
                </select>
            </div>
        </div>

        <div id="foods-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">



        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedCategory = '';
            let selectedCuisine = '';


            $("#category-filter").on("change", function() {
                selectedCategory = $(this).val();
                applyFilters();
            });

            $("#cuisine-filter").on("change", function() {
                selectedCuisine = $(this).val();
                applyFilters();
            });

            function applyFilters() {
                $.ajax({
                    type: "GET",
                    url: "/api/filters",
                    data: {
                        category: selectedCategory,
                        cuisine: selectedCuisine
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function(data) {
                        // Clear the container before appending new data
                        $('#foods-container').empty();

                        // Iterate through the data and create HTML for each food item
                        $.each(data, function(index, food) {
                            var foodHtml = `
                    <div class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                        <img src="${food.filePath}" alt="${food.name}" class="w-full h-48 object-cover rounded-t-lg">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">${food.name}</h2>
                            <p class="text-gray-600 mb-2 text-sm flex items-center space-x-2">
                                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs">${food.cuisine.name}</span>
                                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs">${food.category.name}</span>
                            </p>
                            <p class="text-2xl font-bold text-red-600 mb-4">₱${food.price}</p>
                            <button data-id="${food.id}" data-name="${food.name}"
                                data-category="${food.category.name}" data-price="${food.price}"
                                class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                `;

                            // Append the generated HTML to the container
                            $('#foods-container').append(foodHtml);
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }

            // Get all categories
            $.ajax({
                type: "get",
                url: "/api/categories",
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    const categorySelect = $("#category-filter");
                    categorySelect.empty();
                    categorySelect.append('<option value="" selected>All Categories</option>');
                    $.each(data, function(index, category) {
                        categorySelect.append(
                            `<option value="${category.id}">${category.name}</option>`
                        );
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });

            // Get all cuisines
            $.ajax({
                type: "get",
                url: "/api/cuisines",
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    const cuisineSelect = $("#cuisine-filter");
                    cuisineSelect.empty();
                    cuisineSelect.append('<option value="" selected>All Cuisines</option>');
                    $.each(data, function(index, cuisine) {
                        cuisineSelect.append(
                            `<option value="${cuisine.id}">${cuisine.name}</option>`
                        );
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
            // Get all foods
            $.ajax({
                type: "get",
                url: "/api/get-foods",
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    // Clear the container before appending new data
                    $('#foods-container').empty();

                    // Iterate through the data and create HTML for each food item
                    $.each(data, function(index, food) {
                        var foodHtml = `
                            <div class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                                <img src="${food.filePath}" alt="${food.name}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-6">
                                    <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">${food.name}</h2>
                                    <p class="text-gray-600 mb-2 text-sm flex items-center space-x-2">
                                        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs">${food.cuisine.name}</span>
                                        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs">${food.category.name}</span>
                                      
                                    </p>
                                    <p class="text-2xl font-bold text-red-600 mb-4">₱${food.price}</p>
                                     ${
                                        @json($user) ? `<button data-id="${food.id}" data-name="${food.name}" data-category="${food.category.name}" data-price="${food.price}" class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">Add to Cart</button>` : ''
                                    }
                                </div>
                            </div>
                        `;

                        // Append the generated HTML to the container
                        $('#foods-container').append(foodHtml);
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });

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
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
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
                })
            });
        });
    </script>
    <!-- Initialize autocomplete menu -->
    <script>
        $('#aa-search-input').on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default autocomplete behavior
                // $(this).closest('form').submit(); // Submit the form
                console.log("hi");
            }
        });


        $("#aa-search-input").on("input", function() {
            let query = $(this).val();
            $.ajax({
                type: "POST",
                url: "/api/foods-cuisine",
                data: {
                    query: query,
                },
                datatype: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                        <button data-id="${food.id}" data-name="${food.name}"
                            data-category="${food.category.name}" data-price="${food.price}"
                            class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                            Add to Cart
                        </button>
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
            },

        ]);
    </script>
@endsection
