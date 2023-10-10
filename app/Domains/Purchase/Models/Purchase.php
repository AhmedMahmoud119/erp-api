<?php

namespace App\Domains\Purchase\Models;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use App\Domains\Tax\Models\Tax;
use App\Domains\User\Models\User;
use App\Traits\HasFinancialPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Purchase extends Model
{
    use HasFactory, SoftDeletes,HasFinancialPeriod;

    protected $fillable = [
        'quantity',
        'total',
        'discount',
        'date',
        'invoice_number',
        'creator_id',
        'stock_id',
    ];
    protected $table = 'purchases';
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_products', 'purchase_id', 'product_id')
            ->withPivot('quantity', 'discount')->withTimestamps();
    }
//    public function taxes()
//    {
//        return $this->belongsToMany(Tax::class, 'purchase_taxes', 'purchase_id', 'tax_id')->withTimestamps();
//    }
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function purchasable(): MorphTo
    {
        return $this->morphTo();
    }

}
