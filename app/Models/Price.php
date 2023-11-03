<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prices';

    protected $primaryKey = [
        'item_id',
        'published'
    ];

    public $incrementing = false;

    protected $fillable = [
        'item_id',
        'published',
        'price',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
