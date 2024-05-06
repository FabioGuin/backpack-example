<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\HasInvoiceableAddress;

class AddressRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => [
                'nullable',
                'integer',
                'exists:customers,id',
            ],
            'alias' => 'required|min:3|max:255',
            'state_id' => 'required|exists:states,id',
            'region_id' => 'required|exists:regions,id',
            'province_id' => 'required|exists:provinces,id',
            'municipality_id' => 'nullable|exists:municipalities,id',
            'postal_code' => 'required|numeric',
            'address' => 'required|min:3|max:255',
            'house_number' => 'required|min:1|max:255',
            'completion_address' => 'nullable|min:3|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_invoiceable' => ['required', 'boolean', new HasInvoiceableAddress()],
            'is_default' => 'required|boolean',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        $parentAttributes = parent::attributes();

        return $parentAttributes + [
            'customer_id' => trans('backpack::fields.customer'),
        ];
    }
}
