<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class AddressRandomizeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::query()->with('addresses')->get();

        $this->randomize($customers);
    }

    public function randomize($entities)
    {
        foreach ($entities as $entity) {
            $n = $entity->addresses->count();

            if ($n <= 1) {
                continue;
            }

            foreach ($entity->addresses as $address) {
                Address::where('id', $address->id)->update(['is_default' => 0, 'is_invoiceable' => 0]);
            }

            $ids = $entity->addresses->pluck('id');

            Address::where('id', $ids->random())->update(['is_default' => 1]);
            Address::where('id', $ids->random())->update(['is_invoiceable' => 1]);
            // randomize deleted_at with 1/10 probability
            if (rand(0, 9) == 0) {
                Address::where('id', $ids->random())->update(['deleted_at' => now()]);
            }
        }
    }
}
