<?php

namespace App\Livewire\Admin;

use App\Models\Item;
use App\Models\ItemType;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\UnitRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use function PHPUnit\Framework\isEmpty;

class ItemComponent extends Component
{
    use WithPagination, WithFileUploads;
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
        return view('livewire.admin.item-component',[
            'items' => $this->itemRepository->get($this->search, $this->byTypes),
            'categories' => $this->categoryRepository->getAll(),
            'units' => $this->unitRepository->getAll(),
        ]);
    }

    public function addItem()
    {
        $this->state = [
            'type' => 2,
            'minInventoryLevel' => 0,
            'maxInventoryLevel' => 0,
            'price' => 0,
        ];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createItem()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required|max:50|unique:items,deleted_at,NULL',
            'minInventoryLevel' => 'required|numeric|gte:0',
            'price' => 'numeric|gte:0',
            'maxInventoryLevel' => 'required|numeric|gte:minInventoryLevel',
            'desc' => 'max:200',
            'type' => 'required',
            'category_id'=> 'required_if:type,1,2',
            'unit_id' => 'required',
        ])->validate();

        if(isset($this->state['imgPath']))
        {
            $img_name = Carbon::now()->timestamp. '.' .$this->state['imgPath']->extension();

            $this->state['imgPath']->storeAs('images', $img_name);

            $validatedData['imgPath'] = 'img/uploads/images/' . $img_name;
        }

        $newItem = $this->itemRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm hàng hóa ' . $newItem['name'] . ' thành công!',
        ]);
    }

    public function editItem(Item $item)
    {
        $this->state = $item->toArray();

        if($this->state['type'] != 3)
        {
            $this->state['price'] = $item->prices->first()->price;
        }

        $this->updateItem = $item;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateItem()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:items,name,{$this->updateItem->id},id,deleted_at,NULL",
            'minInventoryLevel' => 'required|numeric|gte:0',
            'price' => 'numeric|gte:0',
            'maxInventoryLevel' => 'required|numeric|gte:minInventoryLevel',
            'desc' => 'max:200',
            'type' => 'required',
            'category_id'=> 'required_if:type,1,2',
            'unit_id' => 'required',
        ])->validate();

        if($this->state['imgPath'] != $this->updateItem->imgPath)
        {
            if ($this->updateItem->imgPath && File::exists($this->updateItem->imgPath)) {
                File::delete($this->updateItem->imgPath);
            }
            if($this->state['imgPath'] != null)
            {
                $img_name = Carbon::now()->timestamp. '.' .$this->state['imgPath']->extension();
                $this->state['imgPath']->storeAs('images', $img_name);
                $validatedData['imgPath'] = 'img/uploads/images/' . $img_name;
            }
            else
            {
                $validatedData['imgPath'] = null;
            }
        }
        $this->itemRepository->update($this->updateItem->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmItemRemoval($itemId)
    {
        $this->itemIdBeingRemoved = $itemId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeItem()
    {
        $item = $this->itemRepository->getById($this->itemIdBeingRemoved);
        if($item->type === 3 && $item->isIngredientOfItems->count() > 0) {
            $this->dispatchBrowserEvent('toastr-error', [
                'message' => 'Hàng hóa đang là nguyên vật liệu của hàng hóa khác!',
            ]);
        }
        else
        {
            $this->itemRepository->delete($this->itemIdBeingRemoved);

            $this->dispatchBrowserEvent('hide-delete-modal', [
                'message' => 'Xóa hàng hóa thành công!',
            ]);
        }
    }

    public function clearImage()
    {
        $this->state['imgPath'] = null;
    }
}
