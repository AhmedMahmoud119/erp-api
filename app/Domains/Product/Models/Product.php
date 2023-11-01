<?php

namespace App\Domains\Product\Models;

use App\Domains\Product\Models\Spec;
use App\Domains\Tax\Models\Tax;
use App\Domains\UnitType\Models\UnitType;
use App\Domains\User\Models\User;
use App\Traits\HasFinancialPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domains\Category\Models\Category;

class Product extends Model
{
    use HasFactory, SoftDeletes,HasFinancialPeriod;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'code',
        'name',
        'description',
        'quantity',
        'opening_stock',
        'selling_price',
        'purchase_price',

        'creator_id',
        'category_id',
        'taxes_id',
        'unit_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function taxes()
    {
        return $this->belongsTo(Tax::class, 'taxes_id');
    }
    public function unit()
    {
        return $this->belongsTo(UnitType::class, 'unit_id');
    }
    public function specs()
    {
        return $this->belongsToMany(Spec::class, 'product_specs')->withPivot('value');
    }
}
