<?php

namespace App\Services\Products;

use App\Clients\GoogleSheetsClient;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
class ProductImportService
{
    protected GoogleSheetsClient $client;

    public function __construct(GoogleSheetsClient $client)
    {
        $this->client = $client;
    }

    public function importFromSheet(string $sheetId, string $range): void
    {
        // dd($this->client);
        $rows = $this->client->getAssocRows($sheetId, $range);

        // берём только первые 3 строки
        // $rows = array_slice($rows, 0, 3);

        foreach ($rows as $item) {
            $category = Category::whereHas('translations', function ($q) use ($item) {
                $q->where('slug', $item['sub_category_slug']);
            })->first();

            $product = Product::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'category_id' => $category?->id,
                    'price' => $item['price'] ?? 0,
                    'seria' => $item['seria'] ?? null,
                    'active' => $item['active'] ?? 1,
                ]
            );

            $product->stock()->updateOrCreate(
                ['product_id' => $product->id],
                ['quantity' => $item['stock_quantity'] ?? 0]
            );

            // Переводы
            foreach (['hy', 'ru', 'en'] as $locale) {
                $product->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'name' => $item["{$locale}_name"] ?? '',
                        'slug' => $item["{$locale}_slug"] ?? Str::slug($item["{$locale}_name"] ?? ''),
                        // 'description' => $item["{$locale}_description"] ?? '',
                    ]
                );
            }

            // ПАРСИНГ attributes
            if (!empty($item['attributes'])) {
                $pairs = explode(';', $item['attributes']);

                foreach ($pairs as $pair) {
                    $pair = trim($pair);
                    if (!$pair) continue;

                    if (!str_contains($pair, '=')) continue;

                    [$slug, $code] = explode('=', $pair);

                    $slug = trim($slug);
                    $code = trim($code);

                    $attribute = Attribute::where('slug', $slug)->first();

                    if (!$attribute) continue;

                    $value = AttributeValue::where('attribute_id', $attribute->id)
                        ->where('code', $code)
                        ->first();

                    if (!$value) continue;

                    // продукт ← значение атрибута
                    $product->attributeValues()->syncWithoutDetaching([$value->id]);

                    // категория ← атрибут (attribute_category)
                    if ($category) {
                        $category->attributes()->syncWithoutDetaching([
                            $attribute->id => ['is_filterable' => true]
                        ]);
                    }
                }
            }

            // КАРТИНКИ

            // main_image
            if (!empty($item['main_image'])) {
                try {
                    $this->saveProductImage($product, $item['main_image'], true);
                } catch (\Throwable $e) {
                    logger()->error('Main image import failed', [
                        'sku' => $product->sku,
                        'url' => $item['main_image'],
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // images (через запятую)
            if (!empty($item['images'])) {
                $images = array_map('trim', explode(',', $item['images']));

                foreach ($images as $imageUrl) {
                    if (!$imageUrl) continue;

                    try {
                        $this->saveProductImage($product, $imageUrl, false);
                    } catch (\Throwable $e) {
                        logger()->error('Image import failed', [
                            'sku' => $product->sku,
                            'url' => $imageUrl,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }
        }
    }

    // private function normalizeGoogleDriveUrl(string $url): string
    // {
    //     $url = trim($url);

    //     if (str_contains($url, 'drive.google.com')) {
    //         if (preg_match('~/file/d/([^/]+)~', $url, $m)) {
    //             return 'https://drive.google.com/uc?export=download&id=' . $m[1];
    //         }
    //     }

    //     return $url;
    // }

    private function normalizeGoogleDriveUrl(string $url): string
    {
        $url = trim($url);

        if (str_contains($url, 'drive.google.com')) {

            // вариант: /file/d/ID
            if (preg_match('~/file/d/([^/]+)~', $url, $m)) {
                return 'https://drive.google.com/uc?export=download&id=' . $m[1];
            }

            // вариант: ?id=ID
            if (preg_match('~id=([^&]+)~', $url, $m)) {
                return 'https://drive.google.com/uc?export=download&id=' . $m[1];
            }
        }

        return $url;
    }


    // private function saveProductImage(Product $product, string $url, bool $isMain = false): void
    // {
    //     // ini_set('memory_limit', '512M');
    //     $url = $this->normalizeGoogleDriveUrl($url);

    //     $existing = $product->images()->where('original_url', $url)->first();
    //     if ($existing) {
    //         if ($isMain && !$existing->is_main) {
    //             $existing->update(['is_main' => true]);
    //         }
    //         return;
    //     }

    //     $response = Http::timeout(60)->get($url);
    //     if (! $response->successful()) {
    //         throw new \Exception('Image download failed: ' . $url);
    //     }

    //     $fileName = Str::uuid() . '.webp';
    //     $path = "products/{$product->id}/{$fileName}";
    //     $fullPath = Storage::disk('public')->path($path);

    //     $directory = dirname($fullPath);
    //     if (!file_exists($directory)) {
    //         mkdir($directory, 0755, true);
    //     }

    //     // Фасад Image теперь использует read()
    //     $image = Image::read($response->body())
    //         ->resize(800, 800, function ($constraint) {
    //             $constraint->aspectRatio();
    //             $constraint->upsize();
    //         })
    //         ->toWebp(90);

    //     $image->save($fullPath);

    //     $product->images()->create([
    //         'path' => $path,
    //         'original_url' => $url,
    //         'is_main' => $isMain,
    //     ]);
    // }

    private function saveProductImage(Product $product, string $url, bool $isMain = false): void
    {
        $url = $this->normalizeGoogleDriveUrl($url);

        $existing = $product->images()->where('original_url', $url)->first();
        if ($existing) {
            if ($isMain && !$existing->is_main) {
                $existing->update(['is_main' => true]);
            }
            return;
        }

        // 1. Первый запрос
        $response = Http::timeout(60)
            ->withOptions([
                'allow_redirects' => true,
                'cookies' => true,
            ])
            ->get($url);

        if (!$response->successful()) {
            throw new \Exception('Download failed: ' . $url);
        }

        $contentType = $response->header('Content-Type');

        // 2. Если не картинка — пробуем confirm token
        if (!str_contains($contentType, 'image')) {

            if (preg_match('/confirm=([0-9A-Za-z_]+)/', $response->body(), $matches)) {

                $confirmUrl = $url . '&confirm=' . $matches[1];

                $response = Http::timeout(60)
                    ->withOptions([
                        'allow_redirects' => true,
                        'cookies' => true,
                    ])
                    ->get($confirmUrl);

                if (!$response->successful()) {
                    throw new \Exception('Confirm download failed: ' . $confirmUrl);
                }

                $contentType = $response->header('Content-Type');
            }
        }

        // 3. Финальная проверка
        if (!str_contains($contentType, 'image')) {
            throw new \Exception('Not an image: ' . $contentType);
        }

        // 4. Сохраняем
        $fileName = Str::uuid() . '.webp';
        $path = "products/{$product->id}/{$fileName}";
        $fullPath = Storage::disk('public')->path($path);

        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        $image = Image::read($response->body())
            ->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->toWebp(90);

        $image->save($fullPath);

        $product->images()->create([
            'path' => $path,
            'original_url' => $url,
            'is_main' => $isMain,
        ]);
    }



}
