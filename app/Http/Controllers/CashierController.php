<?php

namespace App\Http\Controllers;

use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    private $orderRepository;
    public function __construct()
    {
        $this->orderRepository = new OrderRepository;
    }

    public function index()
    {
        return view('cashier.pages.index');
    }

    public function printDupe($orderId)
    {
        $order = $this->orderRepository->getOrderById($orderId);
        $orderDetails = $order->details;

        return view('print.dupe-print', compact('order', 'orderDetails'));
    }
}
