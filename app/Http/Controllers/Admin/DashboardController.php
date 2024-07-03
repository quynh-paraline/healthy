<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $xValues = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        $monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        $months = [];
        foreach ($xValues as $item) {
            $m = $monthNames[$item];
            $months[$item] = $m;
        }

        $orderSuccess = [];
        foreach ($xValues as $item) {
            $orders = Order::whereMonth("created_at", $item + 1)->where("status", 3)->count();
            $orderSuccess[$item] = $orders;
        }

        $orderCancel = [];
        foreach ($xValues as $item) {
            $orders = Order::whereMonth("created_at", $item + 1)->where("status", 7)->count();
            $orderCancel[$item] = $orders;
        }

        $orderReturns = [];
        foreach ($xValues as $item) {
            $orders = Order::whereMonth("created_at", $item + 1)->where("status", 6)->count();
            $orderReturns[$item] = $orders;
        }

        $orderWaiting = [];
        foreach ($xValues as $item) {
            $orders = Order::whereMonth("created_at", $item + 1)->where("status", 0)->count();
            $orderWaiting[$item] = $orders;
        }

        $data1 = $orderCancel;
        $data2 = $orderSuccess;
        $data3 = $orderReturns;
        $data4 = $orderWaiting;

        $totalAll = Order::whereMonth("created_at", now())->sum("expense");
        $total2 = Order::whereMonth("created_at", now())->where("status", 3)->sum("expense");
        $total4 = Order::whereMonth("created_at", now())->where("status", 0)->sum("expense");
        $total3 = Order::whereMonth("created_at", now())->where("status", 6)->sum("expense");
        $total1 = Order::whereMonth("created_at", now())->where("status", 7)->sum("expense");

        return view("admin.dashboard", ["months" => $months,
            "data1" => $data1,
            "data2" => $data2,
            "data3" => $data3,
            "data4" => $data4,
            "totalAll" => $totalAll,
            "total2" => $total2,
            "total4" => $total4,
            "total3" => $total3,
            "total1" => $total1
        ]);
    }
}
