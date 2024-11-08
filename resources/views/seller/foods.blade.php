@extends('seller.layout.app')

@section('title', 'Foods')


@section('styles')
    <style>
        label.error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        textarea.error {
            border-color: red;
        }

        textarea.success {
            border-color: green;
        }

        input.error {
            border-color: red;
        }

        input.success {
            border-color: green;
        }

        select.error {
            border-color: red;
        }

        select.success {
            border-color: green;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="{{ asset('js/seller/food.js') }}"></script>
    <script>
        $("#foodsTable tbody").on("click", "i.deleteBtn", function(e) {

            const food = $(this).data("id");
            const table = $("#foodsTable").DataTable();
            const routeFormat =
                "{{ route('foods.destroy', ['food' => ':food']) }}";
            const finalRoute = routeFormat.replace(":food", food);
            $("#deleteForm").attr("action", finalRoute);
            Swal.fire({
                title: "Do you want to delete this?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#deleteForm").submit();

                }
            });
        });


        function openModal(modalId) {
            const $targetEl = document.getElementById(modalId);
            const modal = new Modal($targetEl);
            modal.show();
        }
        $("#foodsTable tbody").on("click", "i.editBtn", function() {
            console.log("hi");
            const id = $(this).data("id");
            const routeFormat =
                "{{ route('foods.update', ['food' => ':food']) }}";
            const finalRoute = routeFormat.replace(":food", id);
            $("#editForm").attr("action", finalRoute);
            $.ajax({
                type: "GET",
                url: `/api/get-single-food/${id}`,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $("#food_id").val(data.id);
                    $("#editName").val(data.name);
                    $("#editCuisine_id").val(data.cuisine_id);
                    $("#editCategory_id").val(data.category_id);
                    $("#edit_price").val(data.price);
                    openModal("edit-modal");
                },
                error: function(data) {
                    console.log(data);
                },
            });
        });
    </script>
@endsection

@section('content')

    @if (session('icon'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '{{ session('icon') }}',
                    title: '{{ session('title') }}',
                    text: '{{ session('text') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    {{-- Add Modal --}}
    <div id="add-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add New Food
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="add-modal" data-modal-target="add-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="addForm" method="POST" action="{{ route('foods.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')


                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Food Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Food Name" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="cuisine_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Cuisine</label>
                            <select name="cuisine_id" id="cuisine_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Cuisine</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Category</label>
                            <select name="category_id" id="category_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Category</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Price</label>
                            <input type="number" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter food price" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="filePath" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Image</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                name="filePath" id="filePath" type="file">
                        </div>
                    </div>
                    <button type="submit" id="foodAdd"
                        class="text-white flex justify-center items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add New Food
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal  --}}
    <div id="edit-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Food
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="add-modal" data-modal-target="add-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="food_id" id="food_id">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Food Name</label>
                            <input type="text" name="name" id="editName"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Food Name" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="cuisine_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Cuisine</label>
                            <select name="cuisine_id" id="editCuisine_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Cuisine</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Category</label>
                            <select name="category_id" id="editCategory_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Select a Category</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Price</label>
                            <input type="number" name="price" id="edit_price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter food price" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="filePath" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Image</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                name="filePath" id="edit_filePath" type="file">
                        </div>
                    </div>
                    <button type="submit" id="foodUpdate"
                        class="text-white flex justify-center items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fi fi-rr-edit mr-3 mt-1"></i>
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="px-4 pt-6">
        <div
            class="p-10 w-full bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div>
                <h1 class="text-2xl mb-2">Foods</h1>
                <button type="button" id="btnAdd" data-modal-target="add-modal" data-modal-toggle="add-modal"
                    class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Add
                    Food</button>

                <div class="overflow-x-auto">
                    <table class="w-dvw text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        id="foodsTable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cuisine
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td class="px-6 py-3">{{ $food->id }}</td>
                                    <td class="px-6 py-3">{{ $food->name }}</td>
                                    <td class="px-6 py-3">{{ $food->cuisine->name }}</td>
                                    <td class="px-6 py-3">{{ $food->category->name }}</td>
                                    <td class="px-6 py-3">{{ '₱' . $food->price }}</td>
                                    <td class="px-6 py-3">
                                        <img src="{{ $food->filePath }}" alt="{{ $food->name }}"
                                            class="w-16 h-16 object-cover">
                                    </td>
                                    <td class="px-6 py-3">
                                        <!-- Actions like Edit and Delete -->
                                        <button class="text-blue-500 hover:text-blue-600 mr-3">
                                            <i class="fi fi-rr-edit editBtn" data-id="{{ $food->id }}"></i>
                                        </button>
                                        <form action="{{ route('foods.destroy', $food->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700"><i
                                                    class="fi fi-rr-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cuisine
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <form method="POST" id="deleteForm" style="display: none;">
            @csrf
            @method('delete')
            <input type="hidden" name="food_id" id="food_id_delete">
        </form>
    </div>
@endsection
