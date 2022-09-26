<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table      = 'product';
    protected $primaryKey = 'product_id';


    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    public function reports()
    {
        return $this->hasMany(ReportProduct::class, 'product_id', 'product_id');
    }

    public function getComplianceAttribute()
    {
       return $this->reports()->sum('compliance');
    }
}
