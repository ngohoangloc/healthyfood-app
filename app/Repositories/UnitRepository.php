<?php

namespace App\Repositories;

use App\Models\Unit;

class UnitRepository
{
    public function getById($id)
    {
        return Unit::findOrFail($id);
    }

    public function get($searchInput)
    {
        return Unit::where('name', 'LIKE', '%' . $searchInput . '%')->paginate(10);
    }

    public function getAll()
    {
        return Unit::all();
    }

    public function create($request)
    {

        return Unit::create($request);
    }

    public function update($id, $request)
    {
        $unit = Unit::find($id);

        $unit->update($request);
    }

    public function delete($id)
    {
        $unit = $this->getById($id);
        $unit->delete();
    }
}
