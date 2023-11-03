<?php

namespace App\Repositories;
use App\Models\Area;

class AreaRepository
{
    public function getById($id)
    {
        return Area::findOrFail($id);
    }
    public function getAreas($searchInput)
    {
        return Area::where('name', 'LIKE', '%' . $searchInput . '%')->paginate(10);
    }
    public function getAreasIsActive()
    {
        return Area::where('active', true)->get();
    }
    public function create($request)
    {
        return Area::create($request);
    }

    public function update($id, $request)
    {
        $area = Area::find($id);

        $area->update($request);
    }

    public function delete($id)
    {
        $area = $this->getById($id);
        $area->delete();
    }
}
