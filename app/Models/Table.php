<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tables';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'seats',
        'status',
        'area_id'
    ];

    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'table_id');
    }

    public function currentOrder()
    {
        return $this->orders->where('status', '<>', 3)->first();
    }

    public function totalAtTable()
    {
        $total = 0;
        $orderDetails = $this->orders->where('status', '<>', 3)->first()->details;
        foreach ($orderDetails as $orderDetail)
        {
            $total += ($orderDetail->item->prices->first()->price * $orderDetail->quantity );
        }
        return $total;
    }

}
