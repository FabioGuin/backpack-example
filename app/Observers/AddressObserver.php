<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Address;
use App\Models\Customer;

class AddressObserver
{
    public function created(Address $address): void
    {
        $this->handle($address, 'created');
    }

    public function updated(Address $address): void
    {
        $this->handle($address, 'updated');
    }

    private function handle(Address $address, $action): void
    {
        $customerId = $address->customer_id;
        $isDefault = $address->is_default;
        $isInvoiceable = $address->is_invoiceable;

        if ($isDefault || $isInvoiceable) {
            $this->resetAddresses(Customer::class, $customerId, $address->id, $isDefault, $isInvoiceable);
        }
    }

    private function resetAddresses($class, $id, $addressId, $isDefault, $isInvoiceable): void
    {
        $entity = $class::find($id);

        if (! $entity || ! $entity->addresses) {
            return;
        }

        $entity->addresses->each(function ($address) use ($addressId, $isDefault, $isInvoiceable) {
            $updateData = [];
            if ($address->id != $addressId) {
                if ($isDefault) {
                    $updateData['is_default'] = false;
                }
                if ($isInvoiceable) {
                    $updateData['is_invoiceable'] = false;
                }
            } else {
                if ($isDefault) {
                    $updateData['is_default'] = true;
                }
                if ($isInvoiceable) {
                    $updateData['is_invoiceable'] = true;
                }
            }
            if (! empty($updateData)) {
                $address->update($updateData);
            }
        });
    }
}
