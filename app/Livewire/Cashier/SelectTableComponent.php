<?php

namespace App\Livewire\Cashier;

use App\Models\Table;
use App\Repositories\AreaRepository;
use App\Repositories\TableRepository;
use Livewire\Component;
use Livewire\WithPagination;

class SelectTableComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchInput = [
        'searchTable' => null,
    ];
    public $selectingTable = null;
    protected $listeners = [
        'refresh-data' => '$refresh'
    ];
    private $areaRepository;
    private $tableRepository;
    public function __construct()
    {
        $this->tableRepository = new TableRepository;
        $this->areaRepository = new AreaRepository;
    }

    public function render()
    {
        $tables = $this->tableRepository->getTablesWhereAreaActive($this->searchInput['searchTable']);
        $areas = $this->areaRepository->getAreasIsActive();
        return view('livewire.cashier.select-table-component',[
            'tables' => $tables,
            'areas' => $areas,
        ]);
    }

    public function selectTable(Table $table)
    {
        $this->selectingTable = $table;
        $this->emit('selectedTable', $this->selectingTable);
        $this->dispatchBrowserEvent('goToMenuTab');

    }
}
