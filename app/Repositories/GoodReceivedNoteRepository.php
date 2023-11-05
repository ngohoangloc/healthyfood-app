<?php

namespace App\Repositories;

use App\Models\GoodReceivedNote;

class GoodReceivedNoteRepository
{
    public function getById($id)
    {
        return GoodReceivedNote::findOrFail($id);
    }
    public function getGRNs($searchBySupplier)
    {
        return GoodReceivedNote::where('supplier_id', '=',  $searchBySupplier)->paginate(10);
    }

    public function create($request)
    {
        return GoodReceivedNote::create($request);
    }

    public function update($id, $request)
    {
        $grn = GoodReceivedNote::find($id);

        $grn->update($request);
    }

    public function delete($id)
    {
        $grn = $this->getById($id);
        $grn->delete();
    }
}
