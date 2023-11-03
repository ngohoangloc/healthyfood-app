<?php

namespace App\Livewire\Admin;

use App\Models\Unit;
use Livewire\Component;
use App\Repositories\UnitRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class UnitComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateUnit;
    public $showEditModal= false;
    public $unitIdBeingRemoved;
    public $searchInput;
    private $unitRepository;

    public function __construct()
    {
        $this->unitRepository = new UnitRepository();
    }

    public function render()
    {
        return view('livewire.admin.unit-component',[
            'units' => $this->unitRepository->get($this->searchInput),
        ]);
    }


    public function addUnit()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUnit()
    {
        $validatedData = Validator::make($this->state, [
            'symbol' => 'required|max:10|unique:measurement_units,deleted_at,NULL',
            'name' => 'required|max:50|unique:measurement_units,deleted_at,NULL',
            'desc' => 'max:200',
        ])->validate();

        $newUnit = $this->unitRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm nhóm hàng hóa ' . $newUnit['name'] . ' thành công!',
        ]);
    }

    public function editUnit(Unit $unit)
    {
        $this->state = $unit->toArray();

        $this->updateUnit = $unit;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUnit()
    {
        $validatedData = Validator::make($this->state, [
            'symbol' => "required|max:10|unique:measurement_units,symbol,{$this->updateUnit->id},id,deleted_at,NULL",
            'name' => "required|max:50|unique:measurement_units,name, {$this->updateUnit->id},id,deleted_at,NULL",
            'desc' => 'max:200',
        ])->validate();

        $this->unitRepository->update($this->updateUnit->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật nhóm hàng hóa ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmUnitRemoval($unitId)
    {
        $this->unitIdBeingRemoved = $unitId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeUnit()
    {
        $this->unitRepository->delete($this->unitIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa đơn vị tính thành công!',
        ]);
    }
}

