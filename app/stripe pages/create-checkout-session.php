<?php

// require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

header('Content-Type: application/json');


$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price data' => [
      'currency' => 'lkr',
      'unit_amount' => 2000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => URLROOT . '/users/success.html',
  'cancel_url' => URLROOT . '/users/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);