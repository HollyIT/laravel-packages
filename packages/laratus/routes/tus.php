<?php

use Hollyit\Laratus\Http\Controllers\LaratusDeleteController;
use Hollyit\Laratus\Http\Controllers\LaratusHeadController;
use Hollyit\Laratus\Http\Controllers\LaratusOptionsController;
use Hollyit\Laratus\Http\Controllers\LaratusPatchController;
use Hollyit\Laratus\Http\Controllers\LaratusPostController;
use Hollyit\Laratus\LaratusServer;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [],
    'prefix' => config('laratus.route_prefix', 'tus'),
    'as' => 'tus.',
], function () {
    Route::options('/', LaratusServer::class)
        ->name('options');

    Route::post('/', LaratusServer::class)
        ->name('post');

    Route::patch('/{laratus_id}', LaratusServer::class)
        ->name('patch');

    Route::delete('/{laratus_id}', LaratusServer::class)
        ->name('delete');

    Route::match('head', '/{laratus_id}', LaratusServer::class)
        ->name('head');

    Route::any('{any?}', function () {
            return response()->noContent(485);
    })
        ->where('any', '.*')
        ->name('fallback');



});
