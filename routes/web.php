<?php

use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\SearchFeedbackController;
use Illuminate\Support\Facades\Route;
use Statamic\Facades\Site;
use Statamic\Statamic;

Route::statamic('/', 'home');

Statamic::booted(function () {
    Route::name('latest-version.')->group(function () {
        $latestVersion = Site::get('v2.2');

        Route::redirect('/home', $latestVersion->url());
        Route::redirect('/installation', $latestVersion->url().'/installation');
        Route::redirect('/configuring', $latestVersion->url().'/configuring');
        Route::redirect('/multi-site', $latestVersion->url().'/multi-site');
        Route::redirect('/gateways', $latestVersion->url().'/gateways');
        Route::redirect('/shipping', $latestVersion->url().'/shipping');
        Route::redirect('/tags', $latestVersion->url().'/tags');
        Route::redirect('/email', $latestVersion->url().'/email');
        Route::redirect('/how-it-works', $latestVersion->url().'/how-it-works');
        Route::redirect('/knowledge-base/version-control-strategies', $latestVersion->url().'/knowledge-base/version-control-strategies');
        Route::redirect('/extending', $latestVersion->url().'/how-it-works');
        Route::redirect('/product-variants', $latestVersion->url().'/product-variants');
    });

    foreach (Site::all() as $site) {
        Route::name($site->handle().'.')->prefix($site->handle())->group(function () {
            Route::get('/changelog', [ChangelogController::class, 'show'])->name('changelog');
        });
    }
});

Route::redirect('/github', 'https://github.com/doublethreedigital/simple-commerce');
Route::redirect('/discord', 'https://github.com/doublethreedigital/simple-commerce/discussions');

Route::post('/search-feedback', [SearchFeedbackController::class, 'store']);

Route::statamic('/sitemap.xml', 'sitemap', [
    'layout' => null,
    'content_type' => 'xml',
]);
