<?php

namespace App\Http\Controllers\Web\Portfolio;

use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{

    public function __construct(protected PortfolioService $service)
    {
    }

    public function index(){
        $portfolio = $this->service->getActiveRows(['translations', 'images']);

        return Inertia::render('Portfolio/List',
                    [
                        'portfolio' => $portfolio
                    ]
                );
    }
}
