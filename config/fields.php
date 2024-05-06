<?php

declare(strict_types=1);

return [

    'factories' => [
        'customer' => \App\Factories\Fields\CustomerField::class,
        'alias' => \App\Factories\Fields\AliasField::class,
        'state_id' => \App\Factories\Fields\StateIdField::class,
        'region_id' => \App\Factories\Fields\RegionIdField::class,
        'province_id' => \App\Factories\Fields\ProvinceIdField::class,
        'municipality_id' => \App\Factories\Fields\MunicipalityIdField::class,
        'postal_code' => \App\Factories\Fields\PostalCodeField::class,
        'address' => \App\Factories\Fields\AddressField::class,
        'house_number' => \App\Factories\Fields\HouseNumberField::class,
        'completion_address' => \App\Factories\Fields\CompletionAddressField::class,
        'latitude' => \App\Factories\Fields\LatitudeField::class,
        'longitude' => \App\Factories\Fields\LongitudeField::class,
        'is_default' => \App\Factories\Fields\IsDefaultField::class,
        'is_invoiceable' => \App\Factories\Fields\IsInvoiceableField::class,
    ],

];
