<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientDetail extends Model
{
    use HasFactory;

    protected $table = 'ingredient_details';

    protected $fillable = [
        'id',
        'processedFood_id',
        'ingredient_id',
        'quantity'
    ];

    public function processedFood()
    {
        return $this->belongsTo(Item::class,'processedFood_id','id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Item::class,'ingredient_id','id');
    }
}
