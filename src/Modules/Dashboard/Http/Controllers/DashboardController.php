<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('dashboard::index');
    }
}
