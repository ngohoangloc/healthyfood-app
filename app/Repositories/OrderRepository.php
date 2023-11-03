<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderRepository
{
    public function getOrderById($orderId)
    {
        return Order::find($orderId);
    }

    public function getOrdersByTable($tableId)
    {
        return Order::where('table_id', $tableId)->where('status', '<>', 3)->get();
    }
    public function getLatestOrderByTable($tableId)
    {
        return Order::where('table_id', $tableId)->where('status', '<>', 3)->latest()->first();
    }

    public function create($order)
    {
        return Order::create($order);
    }

    public function update($id, $request)
    {
        $order = $this->getOrderById($id);
        $order->update($request);
    }

    public function delete($id)
    {
        $order = $this->getOrderById($id);
        $order->delete();
    }

    public function setStatusByPrintedDupe($id)
    {
        $order = $this->getOrderById($id);
        $order->status = 1;
        $order->save();
    }
}
