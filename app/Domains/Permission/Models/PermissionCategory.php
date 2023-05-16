<?php

namespace App\Domains\Permission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
    use HasFactory;

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
