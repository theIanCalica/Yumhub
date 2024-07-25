<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // Query the orders to get total profit per month
        $profits = Order::selectRaw('YEAR(orders.order_date) as year, MONTH(orders.order_date) as month, SUM(orders_items.qty * foods.price) as total_profit')
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->join('foods', 'orders_items.food_id', '=', 'foods.id')
            ->whereBetween('orders.order_date', [$startOfYear, $endOfYear])
            ->groupByRaw('YEAR(orders.order_date), MONTH(orders.order_date)')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format the data for the chart
        $data = $profits->map(function ($profit) {
            return [
                'month' => Carbon::create()->month($profit->month)->format('F'), // Get month name
                'profit' => $profit->total_profit
            ];
        });

        // Return the data as JSON
        return response()->json($data);
    }
}
