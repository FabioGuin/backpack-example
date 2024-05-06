<?php

declare(strict_types=1);

namespace App\Factories\Columns;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudColumn;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class LatitudeColumn extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'latitude';

    /**
     */
    public function make(array $params): CrudColumn
    {
        $label = $params['label'] ?? trans('backpack::labels.' . self::$entity);

        return CRUD::column(self::$entity)
            ->type('text')
            ->label($label);
    }
}
