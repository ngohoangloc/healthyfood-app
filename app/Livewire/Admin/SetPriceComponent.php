<?php

namespace App\Livewire\Admin;

use App\Models\Item;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\UnitRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class SetPriceComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateItem;
    public $showEditModal= false;
    public $itemIdBeingRemoved;
    public $search;
    public $byTypes = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'byTypes' => ['except' => null],
    ];

    private $itemRepository;
    private $categoryRepository;
    private $unitRepository;

    public function __construct()
    {
        $this->itemRepository = new ItemRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->unitRepository = new UnitRepository();
    }
    public function render()
    {
        return view('livewire.admin.set-price-component',[
            'items' => $this->itemRepository->getProducts($this->search, $this->byTypes),
            'categories' => $this->categoryRepository->getAll(),
            'units' => $this->unitRepository->getAll(),
        ]);
    }

    public function editPrice(Item $item)
    {
        if(isset($this->state))
            $this->state = null;
        $this->state[$item->id] = $item->prices->first()->toArray();
        $this->updateItem = $item;
    }
    public function closeEdit()
    {
        if(isset($this->state))
            $this->state = null;
    }

    public function updatePrice()
    {
        $validatedData = Validator::make($this->state[$this->updateItem->id], [
            'price' => 'required|numeric|gte:0',
        ])->validate();


        $this->itemRepository->updatePrice($this->updateItem->id, $validatedData);
        $this->state = null;
        return redirect()->back();
    }
}

