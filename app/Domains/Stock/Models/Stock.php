<?php

namespace App\Domains\Stock\Models;

use App\Domains\Product\Models\Product;
use App\Domains\User\Models\User;
use App\Domains\Warehouse\Models\Warehouse;
use App\Traits\HasFinancialPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Stock extends Model
{
    use HasFactory, SoftDeletes,HasFinancialPeriod;

    protected $fillable = [
        'quantity',
        'opening_stock',
        'creator_id',
        'product_id',
        'warehouse_id',
        'purchasing_price',
        'selling_price',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

}
