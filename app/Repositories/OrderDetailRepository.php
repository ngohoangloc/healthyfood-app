<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;

class OrderDetailRepository
{
    public function getOrderDetailByItem($id)
    {
        return OrderDetail::where('item_id', $id)->first();
    }
    public function getOrderDetailsByOrder($id)
    {
        return OrderDetail::where('order_id', $id)->get();
    }

    public function getOrderDetailsByTable($id)
    {
        if(Table::find($id)->orders()->where('status', false)->latest()->get() === null)
        {
            return null;
        }
        return Table::find($id)->orders()->where('status', '<>', 3)->latest()->first()->details()->orderBy('created_at', 'ASC')->get();
    }

    public function getOrderDetailByOrderAndByItem($orderId, $itemId)
    {
        return OrderDetail::where('order_id', $orderId)->where('item_id', $itemId)->first();
    }

    public function create($request)
    {
        return OrderDetail::create([
            'item_id' => $request['item_id'],
            'order_id' => $request['order_id'],
            'quantity' => 1,
            'note' => null,
            'user_id' => session()->get('user.id'),
        ]);
    }

    public function increaseQuantity($orderId, $itemId)
    {
        $orderDetail = $this->getOrderDetailByOrderAndByItem($orderId, $itemId);
        if (isset($orderDetail))
        {
            $orderDetail->increment('quantity');
        }
    }

    public function remove($orderId, $itemId)
    {
        $order = Order::find($orderId);
        $orderDetail = OrderDetail::where('order_id', $orderId)->where('item_id', $itemId);
        if (isset($orderDetail))
        {
            $orderDetail->delete();
        }
        if ($order->details->count() == 0)
        {
            //Reset Table Status
            $table = $order->table;
            $table->status = 0;
            $table->save();

            //Delete Order
            $order->delete();
        }
    }

}
