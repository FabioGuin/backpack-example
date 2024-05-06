<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Address;
use App\Observers\AddressObserver;
use App\Observers\CustomerObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Address::observe(AddressObserver::class);
    }
}
