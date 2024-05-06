<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Artisan::call('down');

        $this->call(CustomerSeeder::class);

        // Complementary addresses
        $this->call(AddressSeeder::class);
        $this->call(AddressRandomizeStatusSeeder::class);

        Artisan::call('up');
    }
}
