<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Orders_Items;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\SignatureVerificationException;

class StripeController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // Validate the request
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure user_id is valid
        ]);

        // Retrieve the user's cart
        $cartItems = CartItem::whereHas('cart', function ($query) use ($request) {
            $query->where('user_id', $request->user_id);
        })
            ->with('food') // Eager load the related food items
            ->get();

        // Prepare line items for Stripe
        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'php', // Set currency to Philippine Peso
                    'product_data' => [
                        'name' => $item->food->name, // Food name
                    ],
                    'unit_amount' => $item->food->price * 100,
                ],
                'quantity' => $item->qty,

            ];
        })->toArray();

        // Create Stripe Checkout session
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('home'),
            'cancel_url' => route('home'),
            'metadata' => [
                'user_id' => $request->user_id, // Save user_id in metadata
            ],
        ]);

        return response()->json([
            'sessionUrl' => $session->url
        ]);
    }


    public function handleWebhook(Request $request)
    {
        // Set the Stripe API secret key
        Stripe::setApiKey(config('stripe.sk'));

        // Define your Stripe webhook secret
        $endpoint_secret = config('stripe.webhook_secret');

        // Get the payload and signature header from the request
        $payload = @file_get_contents('php://input');
        $sig_header = $request->header('Stripe-Signature');
        $event = null;


        try {
            // Verify and construct the event
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Log the error
            Log::error('Invalid payload received for webhook', [
                'exception' => $e->getMessage(),
                'payload' => $payload,
            ]);
            // Respond with an error
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            // Log the error
            Log::error('Invalid signature for webhook', [
                'exception' => $e->getMessage(),
                'signature' => $sig_header,
                'payload' => $payload,
            ]);
            // Respond with an error
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\Exception $e) {
            // Log any other unexpected errors
            Log::error('Webhook processing error', [
                'exception' => $e->getMessage(),
                'payload' => $payload,
                'signature' => $sig_header,
            ]);
            // Respond with a generic error
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        try {
            if ($event->type == 'checkout.session.completed') {
                $session = $event->data->object;
                $this->handleSuccessCheckout($session);
            }
        } catch (\Exception $e) {
            Log::error('Error handling event: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        return response()->json(['status' => 'success', 'event' => $event->type], 200);
    }


    protected function handleSuccessCheckout($session)
    {
        $userId = $session->metadata->user_id;

        // Find the cart associated with the session
        $cart = Cart::where('user_id', $userId)->first();
        $cartItems = $cart->cartItems;
        if ($cart) {
            // Create an order and move cart items to the order
            $order = Order::create([
                'user_id' => $userId,
                'order_date' => Carbon::now(),
                'status' => "Processing",
                'mode' => "Card",
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
    }


    public function success()
    {
        return view("index");
    }
}
