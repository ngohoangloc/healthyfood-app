<?php

namespace App\Repositories;
use App\Models\Supplier;

class SupplierRepository
{
    public function getById($id)
    {
        return Supplier::findOrFail($id);
    }
    public function getSuppliers($searchInput)
    {
        return Supplier::where('name', 'LIKE', '%' . $searchInput . '%')->paginate(10);
    }
    public function getAll()
    {
        return Supplier::all();
    }
    public function create($request)
    {
        return Supplier::create($request);
    }

    public function update($id, $request)
    {
        $supplier = Supplier::find($id);

        $supplier->update($request);
    }

    public function delete($id)
    {
        $supplier = $this->getById($id);
        $supplier->delete();
    }
}
