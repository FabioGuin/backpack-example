<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerRepository
{
    protected UserRepository $userRepository;
    protected AddressRepository $addressRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * Create a customer with the given data.
     *
     * @param  array    $data the data to fill the customer with
     * @return Customer the created customer
     */
    public function create(array $data): Customer
    {
        // Resolve
        $customer = new Customer();
        $customer->fill($data);

        $user = $this->userRepository->createUserForCustomer($customer, $data);

        // Save
        // Observer
        //$customer->code = $customer->generateCode($customer->company, $user->id, 'BUYE');
        $customer->save();

        $address = $this->addressRepository->createAddressForCustomer($customer, $data);

        return $customer;
    }

    /**
     * Update a customer by ID.
     *
     * @param  array                  $data the data to update the customer with
     * @param  int                    $id   the ID of the customer to update
     * @throws ModelNotFoundException if the customer is not found
     * @return Customer               the updated customer
     */
    public function update(array $data, int $id): Customer
    {
        $customer = Customer::query()->findOrFail($id) ?? throw new ModelNotFoundException();
        $customer->fill($data);

        $user = $this->userRepository->updateUserForCustomer($customer, $data);

        $customer->save();

        return $customer;
    }
}
