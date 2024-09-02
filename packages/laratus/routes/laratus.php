<?php

use Hollyit\Laratus\Http\Controllers\LaratusOptionsController;
use Hollyit\Laratus\Http\Controllers\LaratusPostController;
use Hollyit\Laratus\Server;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => Hollyit\Laratus\Server::getMiddleware(),
    'prefix' => config('laratus.route_prefix', 'tus'),
    'as' => 'laratus.',
], function () {
    Route::options('/', LaratusOptionsController::class)
        ->name('options');

    Route::post('/', LaratusPostController::class)
        ->name('post');

    //    Route::patch('/{laratus_id}', Server::class)
    //        ->name('patch');
    //
    //    Route::delete('/{laratus_id}', Server::class)
    //        ->name('delete');
    //
    //    Route::match('head', '/{laratus_id}', Server::class)
    //        ->name('head');

    Route::any('{any?}', function () {
        return response()->noContent(485);
    })
        ->where('any', '.*')
        ->name('fallback');

});
