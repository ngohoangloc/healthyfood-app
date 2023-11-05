<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodReceivedNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'good_received_notes';

    protected $fillable = [
        'id',
        'grd_no',
        'date',
        'type',
        'total',
        'note',
        'supplier_id',
        'receiver_id'
    ];


    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
}
