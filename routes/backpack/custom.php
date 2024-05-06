<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Address\AddressCrudController;
use App\Http\Controllers\Admin\Customer\CustomerCrudController;
use App\Http\Controllers\Admin\Dealer\DealerCrudController;
use App\Http\Controllers\Admin\Dealer\PersonalInformationCrudController;
use App\Http\Controllers\Admin\Dealer\ShippingSpecificationsCrudController;
use App\Http\Controllers\Admin\Employee\EmployeeCrudController;
use App\Http\Controllers\Admin\ExcludedShippingZone\ExcludedShippingZoneCrudController;
use App\Http\Controllers\Admin\FlowerColor\FlowerColorCrudController;
use App\Http\Controllers\Admin\Flowering\FloweringCrudController;
use App\Http\Controllers\Admin\MainCategory\MainCategoryCrudController;
use App\Http\Controllers\Admin\Municipality\MunicipalityCrudController;
use App\Http\Controllers\Admin\Origin\OriginCrudController;
use App\Http\Controllers\Admin\PlantColor\PlantColorCrudController;
use App\Http\Controllers\Admin\Product\ProductCrudController;
use App\Http\Controllers\Admin\Province\ProvinceCrudController;
use App\Http\Controllers\Admin\Region\RegionCrudController;
use App\Http\Controllers\Admin\ShippingDay\ShippingDayCrudController;
use App\Http\Controllers\Admin\SpecificCategory\SpecificCategoryCrudController;
use App\Http\Controllers\Admin\State\StateCrudController;
use App\Http\Controllers\Admin\Vbn\VbnCrudController;
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
