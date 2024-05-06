<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CustomerField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'customer';

    /**
     */
    public function make(array $params): CrudPanel
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);

        return CRUD::addField([
            'label' => $label,
            'type' => 'select2_from_ajax',
            'name' => 'customer_id',
            'entity' => 'customer',
            'attribute' => 'company',
            'data_source' => url('api/customer/q/company'),
            'placeholder' => trans('backpack::placeholders.select2_from_ajax'),
            'minimum_input_length' => 1,
            'model' => "App\Models\Customer",
            'method' => 'POST',
            'include_all_form_fields' => true,
            'tab' => $params['tab'] ?? null,
        ]);
    }
}
