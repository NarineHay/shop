<?php

namespace App\Filament\Resources\PortfolioResource\RelationManagers;

use App\Filament\Resources\CategoryResource\RelationManagers\BaseImageRelationManager;
use App\Models\PortfolioImage;

class ImagesRelationManager extends BaseImageRelationManager
{
    protected static string $imageDirectory = 'portfolio';
    protected static string $imageModel = PortfolioImage::class;
    protected static string $ownerKeyName = 'portfolio_id';
}
