<?php

namespace App\Domains\SupplierPurchase\Models;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Tax\Models\Tax;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SupplierPurchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quantity',
        'total',
        'discount',
        'date',
        'invoice_number',
        'creator_id',
        'stock_id',
        'supplier_id',
    ];
    protected $table = 'purchases';
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_products', 'purchase_id', 'product_id')->withPivot('quantity', 'discount')->withTimestamps();
    }
    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'purchase_taxes', 'purchase_id', 'tax_id')->withTimestamps();
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}