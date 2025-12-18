<?php

namespace App\Helpers;

use App\Models\Region;
use Illuminate\Support\Collection;

class RegionsHelper
{
    public static function getAll(): Collection
    {
        $regions = Region::all();

        return $regions;
    }
}
