<?php

namespace App\Livewire\Admin;

use App\Models\Supplier;
use App\Repositories\SupplierRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateSupplier;
    public $showEditModal= false;
    public $supplierIdBeingRemoved;
    public $searchInput;
    private $supplierRepository;

    public function __construct()
    {
        $this->supplierRepository = new SupplierRepository;
    }
    public function render()
    {
        $suppliers = $this->supplierRepository->getSuppliers($this->searchInput);
        return view('livewire.admin.supplier-component',[
            'suppliers'=> $suppliers
        ]);
    }

    public function addSupplier()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createSupplier()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:suppliers,name,NULL,id,deleted_at,NULL",
            'address' => "required|max:100",
            'phone' => "required|digits_between:10,11",
        ])->validate();

        $newSupplier = $this->supplierRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm nhà cung cấp  <b>' . $newSupplier['name'] . '</b> thành công!',
        ]);
    }

    public function editSupplier(Supplier $supplier)
    {
        $this->state = $supplier->toArray();

        $this->updateSupplier = $supplier;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateSupplier()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:suppliers,name,{$this->updateSupplier->id},id,deleted_at,NULL",
            'address' => "required|max:100",
            'phone' => "required|digits:10",
        ])->validate();

        $this->supplierRepository->update($this->updateSupplier->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật nhà cung cấp ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmSupplierRemoval($supplierId)
    {
        $this->supplierIdBeingRemoved = $supplierId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeSupplier()
    {
        $this->supplierRepository->delete($this->supplierIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa khu vực thành công!',
        ]);
    }
}
