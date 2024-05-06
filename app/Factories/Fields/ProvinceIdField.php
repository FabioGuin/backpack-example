<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

class ProvinceIdField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'province_id';

    public function make(array $params): CrudPanel
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);
        $value = $params['value'] ?? null;
        $tab = $params['tab'] ?? null;

        Widget::add()
            ->to('after_content')
            ->type('script')
            ->content('assets/js/admin/forms/reset-dependencies-province.js');

        return CRUD::addField([
            'label' => $label,
            'type' => 'select2_from_ajax',
            'name' => self::$entity,
            'entity' => 'province',
            'attribute' => 'name',
            'data_source' => url('api/province/q/name'),
            'placeholder' => trans('backpack::placeholders.select2_from_ajax'),
            'minimum_input_length' => 1,
            'model' => "App\Models\Province",
            'method' => 'POST',
            'include_all_form_fields' => true,
            'attributes' => ['id' => self::$entity],
            'default' => $value,
            'tab' => $tab,
        ]);
    }
}
