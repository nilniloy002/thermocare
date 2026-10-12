<?php

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use App\Models\NavigationItem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::redirect('/index.html', '/', 301);
Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/products.html', [PageController::class, 'products']);
Route::view('/contact', 'contact')->name('contact');
Route::view('/consultation', 'consultation')->name('consultation');
Route::post('/contact', [EnquiryController::class, 'store'])->name('enquiries.store');
Route::get('/site-data', function () {
    return response()->json([
        'navigation' => NavigationItem::with(['children' => fn ($query) => $query->where('is_visible', true)])
            ->where('location', 'header')->whereNull('parent_id')->where('is_visible', true)->orderBy('sort_order')->get(['id', 'label', 'url', 'menu_type', 'promo_title', 'promo_text', 'promo_button_label', 'promo_button_url', 'open_in_new_tab']),
        'settings' => SiteSetting::pluck('value', 'key'),
    ]);
})->name('site-data');
Route::get('/privacy-policy', [PageController::class, 'page'])->defaults('slug', 'privacy-policy')->name('privacy-policy');
Route::get('/{slug}', [PageController::class, 'productPage'])->where('slug', 'compressor|condenser|evaporator|freezing-systems|chilled-water-systems|sandwich-panels')->name('product-page');
Route::get('/page/{slug}', [PageController::class, 'page'])->name('page.show');
Route::get('/projects.html', fn () => abort(404));
Route::get('/insights.html', fn () => abort(404));

// Preserve the links used by the existing static frontend during the Laravel transition.
Route::get('/{page}.html', function (string $page) {
    abort_unless(view()->exists($page), 404);

    return view($page);
})->where('page', '[A-Za-z0-9-]+');
