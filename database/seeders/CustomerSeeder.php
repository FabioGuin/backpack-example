<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 600; $i++) {
            $this->runSet();
        }
    }

    public function runSet()
    {
        Customer::factory()
            ->count(1)
            ->create();
    }
}
