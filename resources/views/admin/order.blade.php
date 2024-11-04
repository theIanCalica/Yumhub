@extends('admin.layout.app')

@section('title', 'Orders')

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
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="{{ asset('js/order.js') }}"></script>
@endsection

@section('content')

    {{-- Edit modal --}}
    <div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full p-4">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Order</h3>
                <button type="button" id="closeBtn" class="text-gray-400 hover:text-gray-600"
                    data-modal-toggle="edit-modal">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4" id="orderEditForm">
                <input type="hidden" name="id" id="id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="orderID" class="block mb-2 text-sm font-medium text-gray-900">Order ID</label>
                        <input type="text" name="orderID" id="orderID"
                            class="block w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="order_date" class="block mb-2 text-sm font-medium text-gray-900">Order Date</label>
                        <input type="date" name="order_date" id="order_date" readonly
                            class="block w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select name="status" id="status"
                            class="block w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Processing">Processing</option>
                            <option value="In Transit">In Transit</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                </div>
                <button type="submit" id="orderUpdate"
                    class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <i class="fi fi-rr-edit mr-3"></i> Update
                </button>
            </form>
        </div>
    </div>


    <div class="px-4 pt-6">
        <div
            class="p-10 w-full bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div>
                <h1 class="text-2xl mb-2">Orders</h1>
                <div class="overflow-x-auto">
                    <table class="w-dvw text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="ordersTable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

        </div>
    </div>


@endsection
