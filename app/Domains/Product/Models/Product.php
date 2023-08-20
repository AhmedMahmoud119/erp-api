<?php

namespace App\Domains\Product\Models;

use App\Domains\Tax\Models\Tax;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpOffice\PhpSpreadsheet\Calculation\Category;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'opening_stock',
        'selling_prirce',
        'purchase_prirce',
        'creator_id',
        'category_id',
        'taxes_id',
        'unit_id',
        //  In case of expanding should splite into specs
        // 'image',
        // 'height',
        // 'width',
        // 'length',
        // 'size',
        // 'matrial',
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
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function specs()
    {
        return $this->belongsToMany(Specs::class, 'product_specs');
    }
}
