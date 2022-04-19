<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    public function store()
    {
// $charge = Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'usd'));
        $stripe = new Stripe\StripeClient(
            'sk_test_51KolHaFokwkgT8NS78dyKARlomMT10SbbtuvpNQ9SjKag0QV6JcBHlF2ytz4ZPAS2E7ihlKDbQVo3xl9OtK8miHz00DVOqklp6'
        );
        // dd($stripe->prices->all(['limit' => 3])->toArray());
        // $myCard = array('number' => '4000056655665556', 'exp_month' => 1, 'exp_year' => 2023);
        // $charge = Stripe\Charge::create([
        //     "amount" => 10000,
        //     "currency" => "usd",
        //     "customer" => 'cus_LWs0XYwCmGnqHH',
        //     "description" => "Test payment from itsolutionstuff.com."
        // ]);
        // dd($charge);
        $checkoutSession = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost:8080/',
            'cancel_url' => 'http://localhost:8080/',
            'line_items' => [
              [
                'price' => 'price_1KpoyCFokwkgT8NSKqkTrRGO',
                'quantity' => 1,
              ],
            ],
            'mode' => 'payment',
        ]);
        return redirect($checkoutSession->url);
    }
}
