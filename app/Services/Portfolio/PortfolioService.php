<?php

namespace App\Services\Portfolio;

use App\Interfaces\BaseInterface;
use App\Interfaces\Portfolio\PortfolioInterface;
use App\Interfaces\Products\ProductInterface;
use App\Services\BaseService;

class PortfolioService extends BaseService
{

    public function __construct( PortfolioInterface $repository)
    {
        parent::__construct($repository);
    }

    // public function getFeatured(): mixed
    // {
    //     return $this->repository->getFeatured();
    // }
}
