<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

    public function receipt(Request $request)
    {
        $orderId = "9c99533e-1476-4328-a8b9-89b532e1ce78";
        // Fetch the order with its items and associated food details
        $order = Order::with('orderItems.food')->findOrFail($orderId);

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
}
