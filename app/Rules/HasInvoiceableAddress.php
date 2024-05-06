<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Customer;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class HasInvoiceableAddress implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hasInvoiceable = Customer::find($this->data['customer_id'])
            ->addresses()
            ->where('is_invoiceable', true)
            ->exists();

        if (! $hasInvoiceable && ! $this->data['is_invoiceable']) {
            $fail(trans('backpack::validate.not_has_invoiceable'));
        }
    }

    /**
     * Set the data under validation.
     *
     * @param array<string, mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
