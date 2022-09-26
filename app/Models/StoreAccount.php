<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreAccount extends Model
{
    use HasFactory;

    protected $table      = 'account';
    protected $primaryKey = 'account_id';

    public function stores()
    {
        return $this->hasMany(Store::class, 'account_id', 'account_id');
    }
}
