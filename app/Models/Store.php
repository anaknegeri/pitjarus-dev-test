<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table      = 'store';
    protected $primaryKey = 'store_id';

    public function account()
    {
        return $this->belongsTo(StoreAccount::class, 'account_id');
    }

    public function area()
    {
        return $this->belongsTo(StoreArea::class, 'area_id');
    }

    public function reports()
    {
        return $this->hasMany(ReportProduct::class, 'store_id', 'store_id');
    }

    public function getComplianceAttribute()
    {
       return $this->reports()->sum('compliance');
    }
}
