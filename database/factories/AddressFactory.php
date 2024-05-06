<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Dealer;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $regionId = Region::inRandomOrder()->first()->id;
        $provinceId = Province::where('region_id', $regionId)->inRandomOrder()->first()->id;
        $municipalityId = Municipality::where('province_id', $provinceId)->inRandomOrder()->first()->id;

        $customerId = Customer::inRandomOrder()->first()->id;

        return [
            'alias' => fake()->randomElement([
                'Il mio indirizzo',
                'Casa dei miei',
                'Sede lavoro',
                'Casa in montagna',
                'Casa al mare',
            ]),
            'customer_id' => $customerId,
            'state_id' => 1,
            'region_id' => $regionId,
            'province_id' => $provinceId,
            'municipality_id' => $municipalityId,
            'postal_code' => fake()->postcode,
            'address' => fake()->streetName,
            'house_number' => fake()->buildingNumber,
            'completion_address' => fake()->randomElement([fake()->secondaryAddress, null]),
            'latitude' => fake()->latitude,
            'longitude' => fake()->longitude,
            // seeder override them if necessary
            'is_invoiceable' => 1,
            'is_default' => 1,
        ];
    }
}
