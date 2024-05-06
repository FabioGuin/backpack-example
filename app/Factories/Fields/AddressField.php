<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class AddressField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'address';

    /**
     */
    public function make(array $params): CrudField
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);
        $value = $params['value'] ?? null;
        $tab = $params['tab'] ?? null;

        return CRUD::field(self::$entity)
            ->label($label)
            ->value($value)
            ->tab($tab);
    }
}
