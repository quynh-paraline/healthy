<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $months = [];
    public $data1 = [];
    public $data2 = [];
    public $data3 = [];
    public $data4 = [];
    public $totalAll;
    public $total1;
    public $total2;
    public $total3;
    public $total4;

    public function mount()
    {
        $xValues = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        $monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        foreach ($xValues as $item) {
            $this->months[$item] = $monthNames[$item];
        }

        foreach ($xValues as $item) {
            $this->data1[$item] = Order::whereMonth("created_at", $item + 1)->where("status", 7)->count();
            $this->data2[$item] = Order::whereMonth("created_at", $item + 1)->where("status", 3)->count();
            $this->data3[$item] = Order::whereMonth("created_at", $item + 1)->where("status", 6)->count();
            $this->data4[$item] = Order::whereMonth("created_at", $item + 1)->where("status", 0)->count();
        }

        $this->totalAll = Order::whereMonth("created_at", Carbon::now()->month)->sum("expense");
        $this->total2 = Order::whereMonth("created_at", Carbon::now()->month)->where("status", 3)->sum("expense");
        $this->total4 = Order::whereMonth("created_at", Carbon::now()->month)->where("status", 0)->sum("expense");
        $this->total3 = Order::whereMonth("created_at", Carbon::now()->month)->where("status", 6)->sum("expense");
        $this->total1 = Order::whereMonth("created_at", Carbon::now()->month)->where("status", 7)->sum("expense");
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
