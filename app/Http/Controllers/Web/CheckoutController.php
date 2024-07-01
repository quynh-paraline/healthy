<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    public function index()
    {
        $products = session()->has("cart") ? session()->get("cart") : [];
        $total = 0;
        foreach ($products as $item) {
            $total += $item->price * $item->buy_qty;
        }

        if ($total < 50) {
            $total += 3;
        }
        return view("web.checkouts.index", ["products" => $products, "total" => $total]);
    }

    public function thankyou($id)
    {
        $order = Order::find($id);
        return view("web.checkouts.thankyou", ["order" => $order]);
    }

    public function placeOrder()
    {
        $request = request();
        $request->validate([
            "full_name" => "required",
            "email" => "required",
            "address" => "required",
            "city" => "required",
            "phone_number" => "required|min:10|max:20"
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min" => "Phải nhập tối thiểu :min",
            "max" => "Nhập giá trị không vượt quá :max"
        ]);

        $products = session()->has("cart") ? session()->get("cart") : [];
        $total = 0;
        foreach ($products as $item) {
            $total += $item->price * $item->buy_qty;
        }

        if ($total < 50) {
            $total += 3;
        }

        foreach ($products as $item) {
            $buy_qty = $item->buy_qty;
            $product = Product::find($item->id);
            if ($product->qty >= $buy_qty) {
                $new_qty = $product->qty - $buy_qty;
                $product->qty = $new_qty;
                $product->save();
            } else {
                echo '<script>alert("Vui lòng chú ý lại số lượng sản phẩm trong giỏ hàng!");</script>';
            }
        }

        $order = Order::create([
            "full_name" => request("full_name"),
            "email" => request("email"),
            "address" => request("address"),
            "city" => request("city"),
            "phone_number" => request("phone_number"),
            "payment_method" => request("payment_method"),
            "expense" => $total,
        ]);

        foreach ($products as $item) {
            DB::table("order_products")->insert([
                "order_id" => $order->id,
                "product_id" => $item->id,
                "buy_qty" => $item->buy_qty,
                "expense" => $item->price
            ]);
        }

        Session::forget('cart');

        if ($order->payment_method == "PAYPAL") {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('web.successTransaction', ["order" => $order->id]),
                    "cancel_url" => route('web.cancelTransaction', ["order" => $order->id]),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($total, 2, ".", "")
                        ]
                    ]
                ]
            ]);

//            $order->update(["status" => 1, "is_paid" => 1]);

            if (isset($response['id']) && $response['id'] != null) {

                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('web.cancelTransaction')
                    ->with('error', 'Something went wrong.');

            }
        }

        Mail::to($order->email)->send(new OrderMail($order));

        return redirect()->to(route("web.thankyou", ["order" => $order->id]));
    }

    public function successTransaction($id)
    {
        $order = Order::find($id);
        $order->update(["is_paid" => true, "status" => 1]);
        return redirect()->to(route("web.thankyou") . $order->id);
    }

    public function cancelTransaction()
    {
        return redirect()->to(route("web.carts.index"));
    }
}
