<?php

use App\Http\Controllers\ChangelogController;
use Illuminate\Support\Facades\Route;
use Statamic\Facades\Site;
use Statamic\Statamic;

Statamic::booted(function () {
    $latestVersion = Site::get('v2.3');

    Route::name('latest-version-redirects.')->group(function () use ($latestVersion) {
        Route::redirect('/home', $latestVersion->url());
        Route::redirect('/installation', $latestVersion->url().'/installation');
        Route::redirect('/configuring', $latestVersion->url().'/configuring');
        Route::redirect('/multi-site', $latestVersion->url().'/multi-site');
        Route::redirect('/gateways', $latestVersion->url().'/gateways');
        Route::redirect('/shipping', $latestVersion->url().'/shipping');
        Route::redirect('/tags', $latestVersion->url().'/tags');
        Route::redirect('/email', $latestVersion->url().'/notifications');
        Route::redirect('/notifications', $latestVersion->url().'/notifications');
        Route::redirect('/how-it-works', $latestVersion->url().'/how-it-works');
        Route::redirect('/knowledge-base/version-control-strategies', $latestVersion->url().'/knowledge-base/version-control-strategies');
        Route::redirect('/extending', $latestVersion->url().'/knowledge-base/extending');
        Route::redirect('/product-variants', $latestVersion->url().'/product-variants');
        Route::redirect('/upgrade-guide', $latestVersion->url().'/update-guide');
        Route::redirect('/coupons', $latestVersion->url().'/coupons');
    });

    Route::prefix('/latest')->name('latest.')->group(function () use ($latestVersion) {
        Route::get('/{slug}', function ($slug) use ($latestVersion) {
            return redirect($latestVersion->url().'/'.$slug);
        });
    });

    foreach (Site::all() as $site) {
        Route::name($site->handle().'.')->prefix($site->handle())->group(function () {
            Route::get('/changelog', [ChangelogController::class, 'show'])->name('changelog');
        });
    }
});

Route::statamic('/sitemap.xml', 'sitemap', [
    'layout' => null,
    'content_type' => 'xml',
]);
