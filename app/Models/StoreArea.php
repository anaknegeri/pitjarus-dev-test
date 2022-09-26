<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreArea extends Model {
    use HasFactory;

    protected $table      = 'store_area';
    protected $primaryKey = 'area_id';

    public function stores() {
        return $this->hasMany(Store::class, 'account_id', 'account_id');
    }
}
