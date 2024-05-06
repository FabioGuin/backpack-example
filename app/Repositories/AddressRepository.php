<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Address;
use App\Models\Customer;

class AddressRepository
{
    public array $properties = [
        'alias',
        'state_id',
        'region_id',
        'province_id',
        'municipality_id',
        'postal_code',
        'address',
        'house_number',
        'completion_address',
        'latitude',
        'longitude',
        'is_invoiceable',
        'is_default',
    ];

    /**
     * Create an address from a customer and data array.
     */
    public function createAddressForCustomer(Customer $customer, array $data): Address
    {
        $address = new Address();

        foreach ($this->properties as $property) {
            if (isset($data[$property])) {
                $address->$property = $data[$property];
            }
        }

        $customer->addresses()->save($address);

        return $address;
    }
}
