<?php

namespace App\Domains\Category\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'creator_id',
        'parent',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent');
    }

}
