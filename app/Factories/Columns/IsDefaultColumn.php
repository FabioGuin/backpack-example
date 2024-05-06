<?php

declare(strict_types=1);

namespace App\Factories\Columns;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudColumn;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class IsDefaultColumn extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'is_default';

    /**
     */
    public function make(array $params): CrudColumn
    {
        $label = $params['label'] ?? trans('backpack::labels.' . self::$entity);

        return CRUD::column(self::$entity)
            ->type('boolean')
            ->orderable(true)
            ->label($label);
    }
}
