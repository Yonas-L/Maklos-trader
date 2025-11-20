<?php

namespace App\Http\Controllers;

use App\Models\HeroContent;
use App\Models\HeroSlide;
use App\Models\ProductHighlight;
use App\Models\AboutContent;
use App\Models\AboutValue;
use App\Models\ManufacturingStep;
use App\Models\FaqItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Cache key that auto-busts when hero slides change (count or last update)
        $slidesVersion = (HeroSlide::max('updated_at')?->timestamp ?? 0) . ':' . HeroSlide::count();
        $cacheKey = 'homepage_data:' . $slidesVersion;
        $ttl = now()->addHours(12);

        $data = Cache::remember($cacheKey, $ttl, function () {
            $heroSlides = HeroSlide::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(function ($slide) {
                    return [
                        'title' => $slide->title,
                        'caption' => $slide->caption,
                        'image' => $slide->image_path ? asset('storage/' . $slide->image_path) : asset('storage/assets/IMG_6745.JPG'),
                        'button_primary_label' => $slide->button_primary_label,
                        'button_primary_url' => $slide->button_primary_url,
                        'button_secondary_label' => $slide->button_secondary_label,
                        'button_secondary_url' => $slide->button_secondary_url,
                    ];
                });

            $heroContent = HeroContent::where('is_active', true)->first();

            $productHighlights = ProductHighlight::orderBy('sort_order')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'label' => $item->label,
                        'title' => $item->title,
                        'description' => $item->description,
                        'slug' => $item->slug,
                        'image' => $item->image_path ? asset('storage/' . $item->image_path) : asset('storage/assets/IMG_6745.JPG'),
                    ];
                });

            $aboutContent = AboutContent::latest()->first();
            $aboutValues = $aboutContent ? AboutValue::where('about_content_id', $aboutContent->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get() : collect();

            $manufacturingSteps = ManufacturingStep::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(function ($step) {
                    return [
                        'step_number' => $step->step_number,
                        'badge' => $step->badge,
                        'title' => $step->title,
                        'description' => $step->description,
                        'features' => json_decode($step->features, true) ?? [],
                        'image' => $step->image_path ? asset('storage/' . $step->image_path) : asset('storage/assets/IMG_6745.JPG'),
                    ];
                });

            $faqItems = FaqItem::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(function ($item) {
                    return [
                        'category' => $item->category,
                        'question' => $item->question,
                        'answer' => $item->answer,
                    ];
                });

            $siteSettings = SiteSetting::pluck('value', 'key')->all();

            return compact(
                'heroSlides',
                'heroContent',
                'productHighlights',
                'aboutContent',
                'aboutValues',
                'manufacturingSteps',
                'faqItems',
                'siteSettings'
            );
        });

        return view('welcome', $data);
    }
}
