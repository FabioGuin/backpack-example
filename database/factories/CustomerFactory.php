<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use App\Supports\Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $company = fake()->unique()->company;
        $vat = rand(0, 1) . fake()->unique()->regexify('[0-9]{10}');
        $timestamps = Faker::generateTimestamps();

        return [
            'user_id' => $user->id,
            'code' => Faker::userCode($company, $user, 'BUYE'),
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'company' => $company,
            'vat' => $vat,
            'tax_code' => fake()->unique()->randomElement([$vat, Faker::taxCode(), null]),
            'pec' => fake()->unique()->safeEmail,
            'phone_number' => fake()->phoneNumber,
            'phone_number_alt' => fake()->randomElement([fake()->phoneNumber, null]),
            'deleted_at' => $timestamps['deleted_at'],
            'created_at' => $timestamps['created_at'],
            'updated_at' => $timestamps['updated_at'],
        ];
    }
}
