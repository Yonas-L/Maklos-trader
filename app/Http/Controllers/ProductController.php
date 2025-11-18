<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the landing page with featured products.
     */
    public function index(): View
    {
        // Get products from config
        $products = $this->products();
        
        // Group products by category
        $categories = $products
            ->groupBy('category')
            ->map(function ($categoryProducts, $categoryName) {
                return [
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                    'image' => $categoryProducts->first()['hero_image_url'] ?? asset('storage/assets/IMG_6745.JPG'),
                    'products' => $categoryProducts,
                ];
            })
            ->values();

        // Create hero slides from products
        $heroSlides = $products
            ->map(fn ($product) => [
                'image' => $product['hero_image_url'] ?? $product['hero_image'] ?? null,
                'title' => $product['name'] ?? '',
                'caption' => $product['excerpt'] ?? '',
            ])
            ->filter(fn ($slide) => filled($slide['image']))
            ->unique('image')
            ->values();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'heroSlides' => $heroSlides,
        ]);
    }

    /**
     * Display a single product detail page.
     */
    public function show(string $slug): View
    {
        $product = $this->products()
            ->firstWhere('slug', $slug);

        abort_unless($product, 404);

        $related = $this->products()
            ->reject(fn ($item) => Arr::get($item, 'slug') === $slug)
            ->take(3);

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $related,
        ]);
    }

    /**
     * Retrieve the configured products collection.
     */
    protected function products(): Collection
    {
        $items = Config::get('products.items', []);

        return collect($items)
            ->map(function ($item) {
                $item['hero_image_url'] = asset($item['hero_image']);
                $item['secondary_image_url'] = asset($item['secondary_image']);
                $item['gallery_urls'] = collect($item['gallery'] ?? [])
                    ->map(fn ($path) => asset($path))
                    ->all();

                return $item;
            });
    }

    /**
     * Retrieve all image assets stored under storage/app.
     */
    protected function storageImages(): Collection
    {
        $basePath = storage_path('app');

        return collect(File::allFiles($basePath))
            ->filter(function ($file) {
                return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic']);
            })
            ->map(function ($file) use ($basePath) {
                $relative = str_replace('\\', '/', str_replace($basePath, '', $file->getPathname()));
                $relative = ltrim($relative, '/');

                $url = null;
                if (Str::startsWith($relative, 'public/')) {
                    $publicPath = ltrim(Str::after($relative, 'public/'), '/');
                    $url = asset('storage/' . $publicPath);
                }

                return [
                    'path' => $relative,
                    'url' => $url,
                    'title' => Str::of($file->getFilenameWithoutExtension())
                        ->replace(['_', '-'], ' ')
                        ->headline(),
                ];
            });
    }
}
