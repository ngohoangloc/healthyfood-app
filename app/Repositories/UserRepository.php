<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll($searchInput)
    {
        return User::where('fullName', 'LIKE', '%' . $searchInput . '%')->paginate(10);
    }

    public function getById($id)
    {
        return User::where('id', $id)->first();
    }

    public function create($request)
    {
        return User::create($request);
    }

    public function update($id, $request)
    {
        return User::where('id', $id)->update($request);
    }

    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }
}
