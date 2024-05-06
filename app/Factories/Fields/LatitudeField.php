<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class LatitudeField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'latitude';

    /**
     */
    public function make(array $params): CrudField
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);
        $hint = $params['hint'] ?? null;
        $value = $params['value'] ?? null;
        $tab = $params['tab'] ?? null;

        return CRUD::field(self::$entity)
            ->label($label)
            ->hint($hint)
            ->value($value)
            ->attributes([
                'id' => self::$entity,
            ])
            ->tab($tab);
    }
}
