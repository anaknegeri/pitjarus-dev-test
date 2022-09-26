<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProduct extends Model {
    use HasFactory;

    protected $table      = 'report_product';
    protected $primaryKey = 'report_id';
    protected $dates      = ['tanggal'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function store() {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
