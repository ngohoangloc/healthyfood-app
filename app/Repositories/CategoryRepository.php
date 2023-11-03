<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function get($searchInput)
    {
        return Category::where('name', 'LIKE', '%' . $searchInput . '%')->paginate(10);
    }
    public function getAll()
    {
        return Category::all();
    }

    public function create($request)
    {
        return Category::create($request);
    }

    public function update($id, $request)
    {
        $category = Category::find($id);

        $category->update($request);
    }

    public function delete($id)
    {
        $category = $this->getById($id);
        $category->delete();
    }
}
