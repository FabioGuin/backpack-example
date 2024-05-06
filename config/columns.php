<?php

declare(strict_types=1);

return [

    'factories' => [
        'state' => \App\Factories\Columns\StateColumn::class,
        'region' => \App\Factories\Columns\RegionColumn::class,
        'province' => \App\Factories\Columns\ProvinceColumn::class,
        'municipality' => \App\Factories\Columns\MunicipalityColumn::class,
        'postal_code' => \App\Factories\Columns\PostalCodeColumn::class,
        'address' => \App\Factories\Columns\AddressColumn::class,
        'house_number' => \App\Factories\Columns\HouseNumberColumn::class,
        'completion_address' => \App\Factories\Columns\CompletionAddressColumn::class,
        'latitude' => \App\Factories\Columns\LatitudeColumn::class,
        'longitude' => \App\Factories\Columns\LongitudeColumn::class,
        'created_at' => \App\Factories\Columns\CreatedAtColumn::class,
        'updated_at' => \App\Factories\Columns\UpdatedAtColumn::class,
        'alias' => \App\Factories\Columns\AliasColumn::class,
        'is_default' => \App\Factories\Columns\IsDefaultColumn::class,
        'is_invoiceable' => \App\Factories\Columns\IsInvoiceableColumn::class,
    ],

];
