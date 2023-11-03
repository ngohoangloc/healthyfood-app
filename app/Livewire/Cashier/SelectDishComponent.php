<?php

namespace App\Livewire\Cashier;

use App\Models\Item;
use App\Repositories\ItemRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\TableRepository;
use Carbon\Carbon;
use Livewire\Component;

class SelectDishComponent extends Component
{
    protected $listeners = ['selectedTable' => 'selectTable'];
    public $searchInput = [
        'searchDish' => null,
    ];
    public $selectedTable;
    private $itemRepository;
    private $orderRepository;
    private $orderDetailRepository;
    private $tableRepository;

    public function __construct()
    {
        $this->itemRepository = new ItemRepository;
        $this->orderRepository = new OrderRepository;
        $this->orderDetailRepository = new OrderDetailRepository;
        $this->tableRepository = new TableRepository;
    }

    public function selectTable($selectedTable)
    {
        $this->selectedTable = $selectedTable;
        $this->emit('refresh-data');
    }

    public function render()
    {
        $items = $this->itemRepository->getProducts($this->searchInput['searchDish'], null);
        return view('livewire.cashier.select-dish-component',[
            'items' => $items,
        ]);
    }

    public function addItemToOrder(Item $item)
    {
        $selectingTable = $this->tableRepository->getById($this->selectedTable['id']);

        if($selectingTable->status !== 0)
        {
            $orders = $this->orderRepository->getOrdersByTable($selectingTable->id);

            foreach($orders as $order)
            {
                if($order->status === 0)
                {
                    $currentOrder = $order;
                    break;
                }
            }
            if(!isset($currentOrder))
            {
                $newOrder = [
                    'date' => Carbon::now(),
                    'status' => false,
                    'table_id' => $selectingTable->id
                ];
                $currentOrder = $this->orderRepository->create($newOrder);
            }
        }
        else
        {
            $newOrder = [
                'date' => Carbon::now(),
                'status' => false,
                'table_id' => $selectingTable->id
            ];
            $currentOrder = $this->orderRepository->create($newOrder);
            $this->tableRepository->setStatusToOrdering($selectingTable->id);
        }

        $orderDetail = $this->orderDetailRepository->getOrderDetailByOrderAndByItem($currentOrder->id, $item->id);

        if(!$orderDetail)
        {
            $orderDetail = [
                'item_id' => $item->id,
                'order_id' => $currentOrder->id,
            ];
            $this->orderDetailRepository->create($orderDetail);
        }
        else
        {
            $this->orderDetailRepository->increaseQuantity($orderDetail->order_id, $item->id);
        }

        $this->emit('refresh-data');
    }
}
