<?php

namespace App\Livewire\Admin;

use App\Models\Table;
use App\Repositories\AreaRepository;
use App\Repositories\TableRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class TableComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateTable;
    public $showEditModal= false;
    public $tableIdBeingRemoved;
    public $searchInput;
    private $tableRepository;
    private $areaRepository;

    public function __construct()
    {
        $this->tableRepository = new TableRepository();
        $this->areaRepository = new AreaRepository();
    }
    public function render()
    {
        $tables = $this->tableRepository->getTables($this->searchInput);
        $areas = $this->areaRepository->getAreas($this->searchInput);
        return view('livewire.admin.table-component',[
            'tables' => $tables,
            'areas' => $areas,
        ]);
    }

    public function addTable()
    {
        $this->state = [
            'seats' => 4,
        ];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createTable()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required|max:50|unique:tables,deleted_at,NULL',
            'seats' => 'required|numeric',
            'area_id' => 'required'
        ])->validate();

        $newTable = $this->tableRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm ' . $newTable['name'] . ' thành công!',
        ]);
    }

    public function editTable(Table $table)
    {
        $this->state = $table->toArray();

        $this->updateTable = $table;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateTable()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:tables,name,{$this->updateTable->id},id,deleted_at,NULL",
            'seats' => 'required|numeric',
            'area_id' => 'required'
        ])->validate();


        $this->tableRepository->update($this->updateTable->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmTableRemoval($tableId)
    {
        $this->tableIdBeingRemoved = $tableId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeTable()
    {
        $this->tableRepository->delete($this->tableIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa khu vực thành công!',
        ]);
    }
}
