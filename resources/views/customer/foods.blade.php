@extends('customer.layout.app')

@php
    $user = Auth::user();
@endphp
@section('content')
    <div class="container mx-auto py-8 px-8">
        <!-- Search Bar -->
        <div class="flex justify-center mb-8">
            <input type="text" id="search-bar" placeholder="Search for foods..."
                class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500" />
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

            $('#foods-container').on('click', '.add-to-cart', function() {
                const id = $(this).data("id");
                const user_id = @json($user->id);

                $.ajax({
                    type: "POST",
                    url: "/api/carts",
                    data: {
                        food_ID: id,
                        user_id: user_id,
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
@endsection
