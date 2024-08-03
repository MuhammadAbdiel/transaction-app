<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 't_sales';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'id');
    }

    public function salesDet()
    {
        return $this->hasMany(SalesDet::class, 'sales_id', 'id');
    }
}
