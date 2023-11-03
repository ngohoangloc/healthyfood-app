<?php

namespace App\Repositories;

use App\Models\IngredientDetail;

class IngredientDetailRepository
{
    public function getById($id)
    {
        return IngredientDetail::findOrFail($id);
    }

    public function create($request)
    {
        return IngredientDetail::create([
            'processedFood_id' => $request['processedFood_id'],
            'ingredient_id' => $request['ingredient_id'],
            'quantity' => $request['quantity'],
        ]);
    }

    public function updateQuantity($id, $request)
    {
        IngredientDetail::where('id', $id)->update([
            'quantity'=> $request['quantity'],
            ]);
    }

    public function delete($id)
    {
        $ingredient = $this->getById($id);
        $ingredient->delete();
    }
}
