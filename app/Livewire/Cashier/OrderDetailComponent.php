<?php

namespace App\Livewire\Cashier;

use App\Models\OrderDetail;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;

use Livewire\Component;

use function Symfony\Component\String\b;

class OrderDetailComponent extends Component
{
    protected $listeners = [
        'selectedTable' => 'selectTable',
        'refresh-data' => '$refresh'
    ];
    public $selectedTable;
    private $orderDetailRepository;
    private $orderRepository;

    public function __construct()
    {
        $this->orderDetailRepository = new OrderDetailRepository;
        $this->orderRepository = new OrderRepository;
    }

    public function selectTable($selectedTable)
    {
        $this->selectedTable = $selectedTable;
    }

    public function mount()
    {

    }

    public function render()
    {
        if(!$this->selectedTable)
        {
            return view('livewire.cashier.order-detail-component');
        }
        else
        {
            // $printDupeOrder = $this->orderRepository->getLatestOrderByTable($this->selectedTable['id']);
            $orders = $this->orderRepository->getOrdersByTable($this->selectedTable['id']);
            return view('livewire.cashier.order-detail-component',[
                'orders' => $orders,
                // 'printDupeOrder' => $printDupeOrder
            ]);
        }
    }

    public function removeItemInOrder($orderId, $itemId)
    {
        $this->orderDetailRepository->remove($orderId, $itemId);
        $this->emit('refresh-data');
    }

    public function printDupe()
    {
        $orders = $this->orderRepository->getOrdersByTable($this->selectedTable['id']);
        $currentOrder = new OrderDetail;
        $flag = false;
        foreach ($orders as $order)
        {
            if($order->status === 0)
            {
                $currentOrder = $order;
                $flag = true;
                break;
            }
        }
        if($flag)
        {
            $this->dispatchBrowserEvent('print-dupe', ['orderId' => $currentOrder->id]);
            $this->orderRepository->setStatusByPrintedDupe($currentOrder->id);
        }
        else
        {
            $this->dispatchBrowserEvent('toastr-warning', [
                'message' => 'Đã in phiếu chế biến!',
            ]);
        }
    }

    public function printProvisionalInvoice()
    {
        $orders = $this->orderRepository->getOrdersByTable($this->selectedTable['id']);
        $flag = true;
        foreach ($orders as $order)
        {
            if($order->status === 0)
            {
                $this->dispatchBrowserEvent('toastr-warning', [
                    'message' => 'Đã in phiếu chế biến!',
                ]);
                $flag = false;
                break;
            }
        }
        if($flag)
        {

        }
    }
}
