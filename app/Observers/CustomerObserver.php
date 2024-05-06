<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerObserver
{
    /**
     * Saves a customer.
     *
     * @param Customer $customer the customer to save
     */
    public function saving(Customer $customer): void
    {
        if (empty($customer->code)) {
            $customer->code = 'temp-' . Str::uuid()->toString();
        }
    }

    /**
     * Update the customer code if it contains 'temp'.
     *
     * @param Customer $customer the customer object
     */
    public function saved(Customer $customer): void
    {
        if (Str::contains($customer->code, 'temp')) {
            $customer->code = $customer->generateCode('BUYE');
            $customer->save();
        }
    }
}
