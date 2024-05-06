<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;
use App\Models\User;

class UserRepository
{
    /**
     * Create a user from a customer and data array.
     *
     * @param  Customer $customer the customer object
     * @param  array    $data     the data array
     * @return User     the created user object
     */
    public function createUserForCustomer(Customer $customer, array $data): User
    {
        $user = new User();

        $user->email = $data['email'];
        $user->name = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        $customer->user()->associate($user);

        return $user;
    }

    /**
     * Update the user details from the customer data.
     *
     * @param  Customer $customer the customer object
     * @param  array    $data     the data to update the user
     * @return User     the updated user object
     */
    public function updateUserForCustomer(Customer $customer, array $data): User
    {
        $user = $customer->user;

        $user->email = $data['email'];
        $user->name = $data['email'];

        $user->save();

        return $user;
    }
}
