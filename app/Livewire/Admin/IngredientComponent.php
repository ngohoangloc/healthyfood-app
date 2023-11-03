<?php

namespace App\Livewire\Admin;

use App\Models\Item;
use App\Repositories\ItemRepository;
use Livewire\Component;
use Livewire\WithPagination;

class IngredientComponent extends Component
{
    use WithPagination;
    protected $listeners = [
        'refresh' => '$refresh'
    ];
    public $searchInput;
    public $selectingProcessedFood;
    private $itemRepository;
    public function __construct()
    {
        $this->itemRepository = new ItemRepository;
    }
    public function render()
    {
        $processedFoods = $this->itemRepository->getprocessedFoods($this->searchInput);
        return view('livewire.admin.ingredient-component',[
            'processedFoods' => $processedFoods,
        ]);
    }

    public function selectProcessedFood(Item $processedFood)
    {
        $this->selectingProcessedFood = $processedFood;
        $this->emit('refresh');
    }
}
