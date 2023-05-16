<?php

namespace App\Domains\Form\Models;

use App\Domains\Module\Models\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormModule extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'form_id',
        'module_id',
    ];


    public function form(){
        return $this->belongsTo(Form::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }
}
