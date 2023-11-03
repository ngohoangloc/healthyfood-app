<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'date',
        'status',
        'table_id'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
