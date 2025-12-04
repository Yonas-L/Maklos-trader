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
        // Get products from database
        $products = \App\Models\Product::all();

        // Group products by category
        $categories = $products
            ->groupBy('category')
            ->map(function ($categoryProducts, $categoryName) {
                return [
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                    'image' => $categoryProducts->first()->hero_image ? asset('storage/' . $categoryProducts->first()->hero_image) : asset('storage/assets/IMG_6745.JPG'),
                    'products' => $categoryProducts,
                ];
            })
            ->values();

        // Create hero slides from products
        $heroSlides = $products
            ->map(fn($product) => [
                'image' => $product->hero_image ? asset('storage/' . $product->hero_image) : null,
                'title' => $product->name,
                'caption' => $product->excerpt,
            ])
            ->filter(fn($slide) => filled($slide['image']))
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
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();

        $related = \App\Models\Product::where('slug', '!=', $slug)
            ->take(3)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $related,
        ]);
    }
}
