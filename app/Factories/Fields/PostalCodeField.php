<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PostalCodeField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'postal_code';

    /**
     */
    public function make(array $params): CrudField
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);
        $value = $params['value'] ?? null;
        $tab = $params['tab'] ?? null;

        return CRUD::field(self::$entity)
            ->type('number')
            ->label($label)
            ->value($value)
            ->tab($tab);
    }
}
