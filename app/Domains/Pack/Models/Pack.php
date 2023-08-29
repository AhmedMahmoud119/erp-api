<?php

namespace App\Domains\Pack\Models;

use App\Domains\Product\Models\Product;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pack extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'matrial',
        'quantity',
        'price',
        'weight',
        'width',
        'length',
        'height',
        'creator_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'pack_products')->withTimestamps();
    }
}