<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'measurement_units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'symbol',
        'name',
        'desc'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
