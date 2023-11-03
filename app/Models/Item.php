<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'items';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'desc',
        'imgPath',
        'minInventoryLevel',
        'maxInventoryLevel',
        'type',
        'active',
        'category_id',
        'unit_id'
    ];
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'item_id', 'id')->latest('published');
    }


    public function costs()
    {
        return $this->hasMany(Cost::class, 'item_id', 'id');
    }

    public function ingredientDetails()
    {
        return $this->hasMany(IngredientDetail::class,'processedFood_id', 'id');
    }
}
