<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'fullName',
        'address',
        'phone',
        'active',
        'account_id',
        'role_id'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
