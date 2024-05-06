<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Address\AddressCrudController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'), // backpack_middleware()
    ),
], function () {
    // custom super admin and admin routes
    Route::crud('address', AddressCrudController::class);
}); // this should be the absolute last line of this file
