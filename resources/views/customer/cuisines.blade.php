@extends('customer.layout.app')

@section('title', 'Cuisines')

@section('content')
    <div class="container mx-auto py-8 px-8">
        <div id="cuisines-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "/api/cuisines",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var container = $("#cuisines-container");

                    container.empty();

                    data.forEach(function(cuisine) {
                        var cuisineRoute =
                            "{{ route('cuisine.based', ['cuisine' => ':cuisine']) }}";

                        const finalRoute = cuisineRoute.replace(":cuisine", cuisine.name);
                        var card = `
                            <a href="${finalRoute}" class="block bg-white border border-red-200 rounded-lg shadow-md transition-transform transform hover:scale-105">
                                <img src="${cuisine.img_url}" alt="${cuisine.name}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-6">
                                    <h2 class="text-2xl font-semibold text-red-800 mb-2 merriweather-bold">${cuisine.name}</h2>
                                    <p>${cuisine.desc}</p>
                                </div>
                            </a>
                        `;
                        container.append(card);
                    });
                },
                error: function(data) {
                    console.log(data);
                },
            });
        });
    </script>
@endsection
