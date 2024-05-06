<?php

declare(strict_types=1);

namespace App\Factories\Fields;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class IsDefaultField extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'is_default';

    /**
     */
    public function make(array $params): CrudField
    {
        $label = $params['label'] ?? trans('backpack::fields.' . self::$entity);
        $default = $params['default'] ?? 0;
        $hint = $params['hint'] ?? null;
        $tab = $params['tab'] ?? null;

        return CRUD::field(self::$entity)
            ->label($label)
            ->type('switch')
            ->default($default)
            ->hint($hint)
            ->tab($tab);
    }
}
