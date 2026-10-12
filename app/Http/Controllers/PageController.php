<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function products()
    {
        return view('catalog', ['products' => Product::where('is_published', true)->latest()->get()]);
    }

    public function page(string $slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('page', compact('page'));
    }

    public function productPage(string $slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        abort_unless($page->template && view()->exists($page->template), 404);

        return view($page->template, compact('page'));
    }
}
