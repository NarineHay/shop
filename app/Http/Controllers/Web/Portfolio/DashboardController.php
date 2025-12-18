<?php

namespace App\Http\Controllers\Web\Portfolio;

use App\Helpers\RegionsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $regions = RegionsHelper::getAll();

        return Inertia::render('Dashboard',
                    [
                        'regions' => $regions
                    ]
                );
    }
}
