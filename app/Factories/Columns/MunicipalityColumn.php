<?php

declare(strict_types=1);

namespace App\Factories\Columns;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudColumn;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class MunicipalityColumn extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'municipality';

    /**
     */
    public function make(array $params): CrudColumn
    {
        $label = $params['label'] ?? trans('backpack::labels.' . self::$entity);
        $limit = $params['limit'] ?? null;

        $column = CRUD::column(self::$entity);

        if ($limit) {
            $column->limit($limit);
        }

        $column->label($label);

        return $column;
    }
}
