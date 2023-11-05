<?php

namespace App\Livewire\Admin;

use App\Repositories\GoodReceivedNoteRepository;
use App\Repositories\SupplierRepository;
use Livewire\Component;
use Livewire\WithPagination;

class GoodReceivedNoteComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $searchBySupplier;
    private $grnRepository;
    private $supplierRepository;

    public function __construct()
    {
        $this->grnRepository = new GoodReceivedNoteRepository;
        $this->supplierRepository = new SupplierRepository;
    }

    public $showEditModal = false;

    public function render()
    {
        $grns = $this->grnRepository->getGRNs($this->searchBySupplier);
        $suppliers = $this->supplierRepository->getAll();
        return view('livewire.admin.good-received-note-component',[
            'grns' => $grns,
            'suppliers' => $suppliers
        ]);
    }
}
