<?php

namespace App\Repositories\Portfolio;

use App\Interfaces\Portfolio\PortfolioInterface;
use App\Interfaces\Products\ProductInterface;
use App\Models\Portfolio;
use App\Repositories\BaseRepository;

class PortfolioRepository extends BaseRepository implements PortfolioInterface
{
    public function __construct()
    {
        parent::__construct(new Portfolio());
    }

    
}
