<?php

namespace App\Livewire\Admin;

use App\Models\Area;
use App\Repositories\AreaRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class AreaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateArea;
    public $showEditModal= false;
    public $areaIdBeingRemoved;
    public $searchInput;
    private $areaRepository;

    public function __construct()
    {
        $this->areaRepository = new AreaRepository();
    }
    public function render()
    {
        $areas = $this->areaRepository->getAreas($this->searchInput);
        return view('livewire.admin.area-component',[
            'areas' => $areas,
        ]);
    }

    public function addArea()
    {
        $this->state = [
            'active' => true,
        ];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createArea()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:areas,name,NULL,id,deleted_at,NULL",
        ])->validate();

        $validatedData['active']  = $this->state['active'];

        $newArea = $this->areaRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm khu vực ' . $newArea['name'] . ' thành công!',
        ]);
    }

    public function editArea(Area $area)
    {
        $this->state = $area->toArray();

        $this->updateArea = $area;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateArea()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:areas,name,{$this->updateArea->id},id,deleted_at,NULL",
        ])->validate();

        $validatedData['active']  = $this->state['active'];

        $this->areaRepository->update($this->updateArea->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật khu vực ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmAreaRemoval($areaId)
    {
        $this->areaIdBeingRemoved = $areaId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeArea()
    {
        $this->areaRepository->delete($this->areaIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa khu vực thành công!',
        ]);
    }
}
