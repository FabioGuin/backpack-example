<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Address\Setups;

use App\Factories\Column;
use App\Factories\Filter;
use Backpack\CRUD\app\Exceptions\BackpackProRequiredException;

trait ListOperations
{
    /**
     * @throws BackpackProRequiredException
     */
    protected function listOperations(): void
    {
        $this->joinCustomersTable();
        $this->joinUsersTable();
        $this->joinRegionsTable();
        $this->joinProvincesTable();
        $this->joinMunicipalitiesTable();
        $this->selectColumns();
        $this->applySorting();

        $this->crud->setOperationSetting('lineButtonsAsDropdown', true);
        $this->crud->enableExportButtons();

        $this->setupFilters();
        $this->setupColumns();
    }

    protected function joinCustomersTable(): void
    {
        $this->crud->addClause('leftJoin', 'customers', 'addresses.customer_id', '=', 'customers.id');
    }

    protected function joinUsersTable(): void
    {
        $this->crud->addClause('leftJoin', 'users as customers_users', 'customers_users.id', '=', 'customers.user_id');
    }

    protected function joinRegionsTable(): void
    {
        $this->crud->addClause('leftJoin', 'regions as customers_regions', 'customers_regions.id', '=', 'addresses.region_id');
    }

    protected function joinProvincesTable(): void
    {
        $this->crud->addClause('leftJoin', 'provinces as customers_provinces', 'customers_provinces.id', '=', 'addresses.province_id');
    }

    protected function joinMunicipalitiesTable(): void
    {
        $this->crud->addClause('leftJoin', 'municipalities as customers_municipalities', 'customers_municipalities.id', '=', 'addresses.municipality_id');
    }

    protected function selectColumns(): void
    {
        $this->crud->addClause(
            'select',
            [
                'addresses.*',
                'customers.company',
                'customers.code',
                'customers_users.email',
                'customers_regions.name',
                'customers_provinces.name',
                'customers_municipalities.name',
            ]
        );
    }

    protected function applySorting(): void
    {
        // by id
        $this->crud->orderBy('addresses.deleted_at');
    }

    protected function setupFilters(): void
    {
        Filter::make('is_trashed');
        Filter::make('is_not_trashed');
        Filter::make('is_default');
        Filter::make('is_not_default');
        Filter::make('is_invoiceable');
        Filter::make('is_not_invoiceable');

        Filter::make('region');
        Filter::make('province');
        Filter::make('municipality');
        Filter::make('postal_code');
        Filter::make('alias');
        Filter::make('address');
        Filter::make('house_number');
        Filter::make('completion_address');
        Filter::make('longitude');
        Filter::make('latitude');
        Filter::make('created_at', ['table' => $this->table]);
        Filter::make('updated_at', ['table' => $this->table]);
        Filter::make('deleted_at', ['table' => $this->table]);
    }

    protected function setupColumns(): void
    {
        Column::make('postal_code');
        Column::make('alias');
        Column::make('is_default');
        Column::make('is_invoiceable');
    }
}
