<?php

declare(strict_types=1);

return [

    'factories' => [
        'is_trashed' => \App\Factories\Filters\IsTrashedFilter::class,
        'is_not_trashed' => \App\Factories\Filters\IsNotTrashedFilter::class,
        'is_default' => \App\Factories\Filters\IsDefaultFilter::class,
        'is_not_default' => \App\Factories\Filters\IsNotDefaultFilter::class,
        'is_invoiceable' => \App\Factories\Filters\IsInvoiceableFilter::class,
        'is_not_invoiceable' => \App\Factories\Filters\IsNotInvoiceableFilter::class,
        'region' => \App\Factories\Filters\RegionFilter::class,
        'province' => \App\Factories\Filters\ProvinceFilter::class,
        'municipality' => \App\Factories\Filters\MunicipalityFilter::class,
        'postal_code' => \App\Factories\Filters\PostalCodeFilter::class,
        'alias' => \App\Factories\Filters\AliasFilter::class,
        'address' => \App\Factories\Filters\AddressFilter::class,
        'house_number' => \App\Factories\Filters\HouseNumberFilter::class,
        'completion_address' => \App\Factories\Filters\CompletionAddressFilter::class,
        'longitude' => \App\Factories\Filters\LongitudeFilter::class,
        'latitude' => \App\Factories\Filters\LatitudeFilter::class,
        'created_at' => \App\Factories\Filters\CreatedAtFilter::class,
        'updated_at' => \App\Factories\Filters\UpdatedAtFilter::class,
        'deleted_at' => \App\Factories\Filters\DeletedAtFilter::class,
    ],

];
