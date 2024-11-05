<?php

use App\Http\Controllers\V2\LinkController;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{key}', [LinkController::class, 'redirect'])->name('short.url');

Scramble::registerUiRoute(path: 'docs/v1', api: 'v1');
Scramble::registerJsonSpecificationRoute(path: 'docs/v1.json', api: 'v1');

Scramble::registerUiRoute(path: 'docs/v2', api: 'v2');
Scramble::registerJsonSpecificationRoute(path: 'docs/v2.json', api: 'v2');
