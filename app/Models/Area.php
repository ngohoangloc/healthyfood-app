<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'areas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'active'
    ];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function isActive()
    {
        return $this->active == true;
    }
}
