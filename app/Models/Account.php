<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accounts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'username',
        'password',
        'active'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'account_id');
    }
}
