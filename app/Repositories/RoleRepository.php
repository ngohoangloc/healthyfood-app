<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    public function getById($id)
    {
        return Role::findOrFail($id);
    }

    public function get($searchInput)
    {
        return Role::where('name', 'LIKE', '%' . $searchInput . '%')->paginate(10);
    }

    public function getAll()
    {
        return Role::all();
    }

    public function create($request)
    {

        return Role::create($request);
    }

    public function update($id, $request)
    {
        $role = Role::find($id);

        $role->update($request);
    }

    public function delete($id)
    {
        $role = $this->getById($id);
        $role->delete();
    }
}
