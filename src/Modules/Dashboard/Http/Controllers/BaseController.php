<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        config()->set('breadcrumbs.view', 'dashboard::partials/breadcrumbs');
        config()->set('breadcrumbs.files', base_path('Modules/Dashboard/Routes/breadcrumbs.php'));
    }
}
