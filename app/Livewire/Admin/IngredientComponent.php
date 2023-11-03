<?php

namespace App\Livewire\Admin;

use App\Models\IngredientDetail;
use App\Models\Item;
use App\Repositories\IngredientDetailRepository;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class IngredientComponent extends Component
{
    use WithPagination;
    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public $state = [];
    public $searchInput;
    public $selectingProcessedFood;
    public $ingredientIdBeingRemoved;
    public $updateIngredientDetail;
    private $itemRepository;
    private $ingredientDetailRepository;
    public function __construct()
    {
        $this->itemRepository = new ItemRepository;
        $this->ingredientDetailRepository = new IngredientDetailRepository;
    }
    public function render()
    {
        $processedFoods = $this->itemRepository->getprocessedFoods($this->searchInput);
        $ingredients = $this->itemRepository->getIngredients(null);
        return view('livewire.admin.ingredient-component',[
            'processedFoods' => $processedFoods,
            'ingredients' => $ingredients,
        ]);
    }

    public function selectProcessedFood(Item $processedFood)
    {
        $this->selectingProcessedFood = $processedFood;
        $this->emit('refresh');
    }

    public function showFormIngredient()
    {
        $this->state = [
            'quantity' => 0
        ];

        $this->dispatchBrowserEvent('show-form');
    }

    public function addIngredient()
    {
        $this->state['processedFood_id'] = $this->selectingProcessedFood->id;
        $validatedData = Validator::make($this->state, [
            'quantity' => 'required|numeric|gte:0',
            'processedFood_id' => 'required',
            'ingredient_id' => 'required',
        ])->validate();

        $this->ingredientDetailRepository->create($validatedData);

        $this->emit('refresh');
        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm định lượng thành công!',
        ]);
    }

    public function editIngredient(IngredientDetail $ingredientDetail)
    {
        if(isset($this->state))
            $this->state = null;
        $this->state[$ingredientDetail->id] = $ingredientDetail->toArray();
        $this->updateIngredientDetail = $ingredientDetail;
    }

    public function updateIngredient()
    {
        $validatedData = Validator::make($this->state[$this->updateIngredientDetail->id], [
            'quantity' => 'required|numeric|gte:0',
        ])->validate();


        $this->ingredientDetailRepository->updateQuantity($this->updateIngredientDetail->id, $validatedData);
        $this->emit('refresh');
        $this->state = null;
    }

    public function closeEdit()
    {
        if(isset($this->state))
            $this->state = null;
    }

    public function confirmIngredientRemoval($ingredientId)
    {
        $this->ingredientIdBeingRemoved = $ingredientId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeIngredient()
    {
        $this->ingredientDetailRepository->delete($this->ingredientIdBeingRemoved);
        $this->emit('refresh');
        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa định lượng thành công!',
        ]);
    }
}
