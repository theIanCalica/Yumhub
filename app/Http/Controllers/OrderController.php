<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orders_Items;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{

    public function add_to_cart(string $id)
    {
        dd($id);
    }

    public function getMonthlyProfit()
    {
        // Get the start and end of the current year
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // Query the orders to get total revenue and commission per month
        $profits = Order::selectRaw('YEAR(orders.order_date) as year, MONTH(orders.order_date) as month, SUM(orders_items.qty * foods.price) as total_revenue')
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->join('foods', 'orders_items.food_id', '=', 'foods.id')
            ->whereBetween('orders.order_date', [$startOfYear, $endOfYear])
            ->groupByRaw('YEAR(orders.order_date), MONTH(orders.order_date)')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format the data for the chart
        $data = $profits->map(function ($profit) {
            $totalRevenue = $profit->total_revenue;
            $commission = $totalRevenue * 0.30;
            return [
                'month' => Carbon::create()->month($profit->month)->format('F'), // Get month name
                'revenue' => $totalRevenue,
                'commission' => $commission
            ];
        });

        // Return the data as JSON
        return response()->json($data);
    }

    public function getByCuisine()
    {
        $ordersPerCuisine = DB::table('orders')
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->join('foods', 'orders_items.food_id', '=', 'foods.id')
            ->join('cuisines', 'foods.cuisine_id', '=', 'cuisines.id')
            ->select('cuisines.name', DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->groupBy('cuisines.name')
            ->get();

        return $ordersPerCuisine;
    }

    public function receipt(string $id)
    {

        // Fetch the order with its items and associated food details
        $order = Order::with('orderItems.food')->findOrFail($id);

        // Pass the order data to the PDF view
        $data = [
            'order' => $order,
            'orderItems' => $order->orderItems,
        ];


        $pdf = PDF::loadView('customer.receipt', $data);
        return $pdf->download('receipt.pdf');
    }

    public function getSalesDataResto(string $id)
    {
        $restaurant = Restaurant::where("owner_id", $id)->first();
        // Get the start and end of the current year
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // Query the orders to get total revenue and profit per month for the specified seller
        $profits = Order::selectRaw('YEAR(orders.order_date) as year, MONTH(orders.order_date) as month, SUM(orders_items.qty * foods.price) as total_revenue')
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->join('foods', 'orders_items.food_id', '=', 'foods.id')
            ->where('foods.restaurant_id', $restaurant->id) // Filter by seller ID in the foods table
            ->whereBetween('orders.order_date', [$startOfYear, $endOfYear])
            ->groupByRaw('YEAR(orders.order_date), MONTH(orders.order_date)')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format the data for the chart
        $data = $profits->map(function ($profit) {
            $totalRevenue = $profit->total_revenue;
            $profitAfter30Percent = $totalRevenue * 0.70; // Profit is 70% of the total revenue after removing 30%
            return [
                'month' => Carbon::create()->month($profit->month)->format('F'), // Get month name
                'revenue' => $totalRevenue,
                'profit' => $profitAfter30Percent,
            ];
        });

        // Return the data as JSON
        return response()->json($data);
    }

    public function getCategoryPerResto(string $id)
    {
        // Retrieve the restaurant by owner ID
        $restaurant = Restaurant::where('owner_id', $id)->first();

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        // Fetch the total number of orders for each category
        $categoryOrders = DB::table('orders')
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->join('foods', 'orders_items.food_id', '=', 'foods.id')
            ->join('categories', 'foods.category_id', '=', 'categories.id')
            ->where('foods.restaurant_id', $restaurant->id)
            ->select(
                'categories.name as name',
                DB::raw('COUNT(DISTINCT orders.id) as total_orders')
            )
            ->groupBy('categories.name')
            ->get();

        return response()->json($categoryOrders);
    }

    public function checkout_cod(Request $request)
    {
        $id = $request->input("user_id");
        $cart = Cart::where('user_id', $id)->first();
        $cartItems = $cart->cartItems;
        if ($cart) {
            // Create an order and move cart items to the order
            $order = Order::create([
                'user_id' => $id,
                'order_date' => Carbon::now(),
                'status' => "Processing",
                'mode' => "COD",
            ]);

            foreach ($cartItems as $cartItem) {
                Orders_Items::create([
                    'order_id' => $order->id,
                    'food_id' => $cartItem->food_id,
                    'qty' => $cartItem->qty,
                ]);
            }
            $cart->delete();
        }

        return response()->json(["order" => $order, "status" => 202]);
    }

    public function my_order(string $id)
    {
        $orders = Order::where('user_id', $id)->get();

        return response()->json(['orders' => $orders]);
    }

    public function my_order_items(string $id)
    {

        $order = Order::with("orderItems.food")->findOrFail($id);
        // Pass the order data to the PDF view
        $orderItems = $order->orderItems;
        return response($orderItems);
    }
}
