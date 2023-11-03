<?php

namespace App\Repositories;
use App\Models\Table;

class TableRepository
{
    public function getById($id)
    {
        return Table::findOrFail($id);
    }
    public function getTables($searchInput)
    {
        return Table::where('name', 'LIKE', '%' . $searchInput . '%')->paginate(25);
    }

    public function getTablesWhereAreaActive($searchInput)
    {
        return Table::whereHas('area', function ($query) {
            $query->where('active', 1);
        })->where('name', 'LIKE', '%' . $searchInput . '%')->orderBy('id', 'asc')->paginate(24);
    }

    public function create($request)
    {
        return Table::create($request);
    }

    public function update($id, $request)
    {
        $table = Table::find($id);

        $table->update($request);
    }

    public function setStatusToOrdering($id)
    {
        $table = $this->getById($id);
        if($table->status == 0)
            $table->status = 1;
        $table->save();
    }

    public function delete($id)
    {
        $table = $this->getById($id);
        $table->delete();
    }
}
