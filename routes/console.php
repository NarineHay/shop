<?php

use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('storage:repair-category-images', function () {
    $repaired = 0;
    $skipped = 0;
    $extensions = ['avif', 'gif', 'jpeg', 'jpg', 'png', 'svg', 'webp'];

    Category::query()
        ->where(fn ($query) => $query->whereNull('image')->orWhere('image', ''))
        ->eachById(function (Category $category) use (&$repaired, &$skipped, $extensions) {
            $files = collect(Storage::disk('public')->files("categories/{$category->id}"))
                ->filter(fn (string $path) => in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), $extensions, true))
                ->values();

            if ($files->count() !== 1) {
                if ($files->isNotEmpty()) {
                    $this->warn("Category {$category->id}: found {$files->count()} images, skipped.");
                    $skipped++;
                }

                return;
            }

            $category->forceFill(['image' => $files->first()])->saveQuietly();
            $this->line("Category {$category->id}: restored {$files->first()}.");
            $repaired++;
        });

    $this->info("Category images repaired: {$repaired}; skipped: {$skipped}.");
})->purpose('Restore missing category image paths from public storage');
