<?php

namespace App\Domains\Module\Controllers;

use App\Domains\Module\Models\Module;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    public function index()
    {
        return Module::get();
    }
}
