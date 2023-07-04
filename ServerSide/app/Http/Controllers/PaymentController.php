<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $customer = Customer::create([
                'name' => $request->input('name'), // User's name
                'email' => $request->input('email'), // User's email (optional)
            ]);
            // Create a charge using the Stripe API
            $charge = Charge::create([
                'amount' => 15000, // Amount in cents
                'currency' => 'usd',
                'source' => "tok_visa", // Stripe token obtained from the client-side
                'description' => 'Add Pharmacy or Store',
//                'payment_method'=>$request->payment_method,
//                'customer' => $customer->id,
            ]);
            $charge->customer=$customer->id;
            $charge->save();

            // Payment successful
            return response()->json(['success' => 'Payment completed successfully']);
        } catch (\Exception $e) {
            // Payment failed
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
