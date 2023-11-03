<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\Price;
use Illuminate\Support\Facades\File;

class ItemRepository
{
    public function getById($id)
    {
        return Item::findOrFail($id);
    }

    public function get($searchInput, $byTypes)
    {
        $query = Item::query();

        // Lọc theo loại hàng hóa (nếu có)
        if ($byTypes != null) {
            $query->whereIn('type', $byTypes);
        }

        // Tìm kiếm theo tên hàng hóa (nếu có)
        if (!empty($searchInput)) {
            $query->where('name', 'LIKE', '%' . $searchInput . '%')
                    ->orWhere('id', 'LIKE', '%' . $searchInput . '%');
        }

        // Kèm theo các mối quan hệ và phân trang
        return $query->with('unit', 'category', 'prices', 'costs')->paginate(10);
    }

    public function getProducts($searchInput, $byTypes)
    {
        $query = Item::query();

        $query->where('type', '<>', 3);
        $query->where('active', true);

        if ($byTypes != null) {
            $query->whereIn('type', $byTypes);
        }
        if (!empty($searchInput)) {
            $query->where('name', 'LIKE', '%' . $searchInput . '%')
                    ->orWhere('id', 'LIKE', '%' . $searchInput . '%');
        }
        return $query->with('unit', 'category', 'prices', 'costs')->paginate(10);
    }

    public function getprocessedFoods($searchInput)
    {
        $query = Item::query();

        $query->where('type', '=', 2);
        $query->where('active', true);

        if (!empty($searchInput)) {
            $query->where('name', 'LIKE', '%' . $searchInput . '%')
                    ->orWhere('id', 'LIKE', '%' . $searchInput . '%');
        }
        return $query->with('unit', 'category', 'prices', 'costs')->paginate(10);
    }

    public function getIngredients($searchInput)
    {
        $query = Item::query();

        $query->where('type', '=', 3);
        $query->where('active', true);

        if (!empty($searchInput)) {
            $query->where('name', 'LIKE', '%' . $searchInput . '%');
        }
        return $query->with('unit', 'category', 'costs')->paginate(10);
    }

    public function create($request)
    {
        if($request['type'] == 1)
        {
            $itemId = 'HH' . str_pad((Item::withTrashed()->count() + 1), 4, '0', STR_PAD_LEFT);
        }
        if($request['type'] == 2)
        {
            $itemId = 'TP' . str_pad((Item::withTrashed()->count() + 1), 4, '0', STR_PAD_LEFT);
        }
        if($request['type'] == 3)
        {
            $itemId = 'NVL' . str_pad((Item::withTrashed()->count() + 1), 3, '0', STR_PAD_LEFT);
        }

        $request['id'] = $itemId;

        $newItem = Item::create($request);
        if ($newItem->type != 3)
        {
            Price::create([
                'item_id' => $newItem->id,
                'published' => now()->toDateTime(),
                'price' => $request['price'],
            ]);
        }

        return $newItem;
    }

    public function update($id, $request)
    {
        $item = Item::find($id);

        $item->update($request);

        if ($item->type != 3 && ($item->prices->first()->price != $request['price']))
        {
            Price::create([
                'item_id' => $item->id,
                'published' => now()->toDateTime(),
                'price' => $request['price'],
            ]);
        }
    }
    public function updatePrice($id, $request)
    {
        Price::create([
            'item_id' => $id,
            'published' => now()->toDateTime(),
            'price' => $request['price'],
        ]);
    }

    public function delete($id)
    {
        $item = $this->getById($id);
        if ($item->imgPath && File::exists($item->imgPath)) {
            File::delete($item->imgPath);
            $item->imgPath = null;
        }
        $item->delete();
    }
}
