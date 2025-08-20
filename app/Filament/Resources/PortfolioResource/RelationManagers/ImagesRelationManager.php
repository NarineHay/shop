<?php

namespace App\Filament\Resources\PortfolioResource\RelationManagers;

use App\Models\PortfolioImage;
use App\Filament\Resources\RelationManagers\BaseImageRelationManager;

class ImagesRelationManager extends BaseImageRelationManager
{
    protected static string $imageDirectory = 'portfolio';
    protected static string $imageModel = PortfolioImage::class;
}
