<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class MunicipalityIdField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'municipality_id';

    public function make(array $params): CrudPanel
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);
        $value = $params['value'] ?? null;
        $tab = $params['tab'] ?? null;

        return CRUD::addField([
            'label' => $label,
            'type' => 'select2_from_ajax',
            'name' => self::$entity,
            'entity' => 'municipality',
            'attribute' => 'name',
            'data_source' => url('api/municipality/q/name'),
            'placeholder' => trans('backpack::placeholders.select2_from_ajax'),
            'minimum_input_length' => 1,
            'model' => "App\Models\Municipality",
            'method' => 'POST',
            'include_all_form_fields' => true,
            'attributes' => ['id' => self::$entity],
            'default' => $value,
            'tab' => $tab,
        ]);
    }
}
