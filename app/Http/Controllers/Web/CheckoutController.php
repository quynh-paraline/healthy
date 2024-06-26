<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {
        return view("web.checkouts.index");
    }

    public function thankyou($id)
    {
        $order = Order::find($id);
        return view("web.checkouts.thankyou", ["order" => $order]);
    }
}
