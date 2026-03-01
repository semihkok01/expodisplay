<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $galleryItems = trans('home.gallery.items');
        $videoSources = [
            asset('assets/videos/screen_01.mp4'),
            asset('assets/videos/screen_02.mp4'),
            asset('assets/videos/screen_03.mp4'),
            asset('assets/videos/screen_04.mp4'),
        ];

        $videoShowcaseItems = collect($galleryItems)->values()->map(function (array $item, int $index) use ($videoSources) {
            return [
                'src' => $videoSources[$index] ?? $videoSources[0],
                'title' => $item['title'],
                'label' => $item['label'],
            ];
        })->all();

        return view('home', [
            'features' => trans('home.features.items'),
            'showcases' => trans('home.showcase.items'),
            'videoShowcaseItems' => $videoShowcaseItems,
            'audiences' => trans('home.audiences.items'),
            'testimonials' => trans('home.references.testimonials'),
            'stats' => trans('home.references.stats'),
            'faqs' => trans('home.faq.items'),
        ]);
    }
}
