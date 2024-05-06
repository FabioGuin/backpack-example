<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Address;

use App\Factories\Column;
use App\Factories\Field;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Backpack\CRUD\app\Exceptions\BackpackProRequiredException;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class AddressCrudController
 *
 * @property-read CrudPanel $crud
 */
class AddressCrudController extends CrudController
{
    use \App\Http\Controllers\Admin\Address\Setups\ListOperations;
    use \App\Traits\CrudPermission;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\Pro\Http\Controllers\Operations\BulkTrashOperation;
    use \Backpack\Pro\Http\Controllers\Operations\TrashOperation;

    protected string $table = 'addresses';

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * @throws Exception
     */
    public function setup(): void
    {
        $this->setAccessUsingPermissions();

        CRUD::setModel(Address::class);
        $this->setRouteByArea('address');
        CRUD::setEntityNameStrings(
            trans('backpack::entities.address'),
            trans('backpack::entities.addresses')
        );

        $this->crud->enableDetailsRow();

        $this->filterRecordsBasedOnRole();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @throws BackpackProRequiredException
     */
    protected function setupListOperation(): void
    {
        $this->listOperations();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     */
    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(AddressRequest::class);

        Field::make('customer');
        Field::make('alias');
        Field::make('state_id');
        Field::make('region_id');
        Field::make('province_id');
        Field::make('municipality_id');
        Field::make('postal_code');
        Field::make('address');
        Field::make('house_number');
        Field::make('completion_address', ['hint' => trans('backpack::hints.completion_address')]);
        Field::make('latitude', ['hint' => trans('backpack::hints.latitude')]);
        Field::make('longitude', ['hint' => trans('backpack::hints.longitude')]);
        Field::make('is_default', ['hint' => trans('backpack::hints.address.is_default')]);
        Field::make('is_invoiceable', ['hint' => trans('backpack::hints.is_invoiceable')]);

        Widget::add()
            ->to('after_content')
            ->type('script')
            ->content('assets/js/admin/forms/geocode.js');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     */
    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    /**
     * @throws BackpackProRequiredException
     */
    protected function setupShowOperation(): void
    {
        $this->setupListOperation();

        Column::make('state');
        Column::make('region');
        Column::make('province');
        Column::make('municipality');
        Column::make('postal_code');
        Column::make('address');
        Column::make('house_number');
        Column::make('completion_address');
        Column::make('latitude');
        Column::make('longitude');

        Column::make('created_at');
        Column::make('updated_at');
    }

    public function showDetailsRow(int $id): Factory|View
    {
        $this->crud->hasAccessOrFail('list');

        $entry = $this->crud->getEntry($id);

        $this->data['address'] = $entry;

        return view('crud::address_lists_details_row', $this->data);
    }

    public function setupTrashOperation(): void
    {
        $this->crud->setOperationSetting('withTrashFilter', false);
    }
}
