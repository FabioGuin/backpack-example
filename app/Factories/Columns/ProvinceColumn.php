<?php

declare(strict_types=1);

namespace App\Factories\Columns;

use App\Contracts\Abstracts\ComponentWithRoleHandlingFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudColumn;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

class ProvinceColumn extends ComponentWithRoleHandlingFactoryAbstract
{
    protected static string $entity = 'province';

    /**
     */
    public function make(array $params): CrudColumn
    {
        $label = $params['label'] ?? trans('backpack::labels.' . self::$entity);
        $limit = $params['limit'] ?? null;

        $column = CRUD::column(self::$entity)->orderable(true)
            ->label($label)
            ->orderLogic(function ($query, $column, $column_direction) {
                return $query->orderBy(Str::plural(self::$entity) . '.name', $column_direction);
            })
            ->searchLogic(function ($query, $column, $searchTerm) {
                return $query->orWhere(Str::plural(self::$entity) . '.name', 'LIKE', "%{$searchTerm}%");
            });

        if ($limit) {
            $column->limit($limit);
        }

        return $column;
    }
}
