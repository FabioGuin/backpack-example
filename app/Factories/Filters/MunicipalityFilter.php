<?php

declare(strict_types=1);

namespace App\Factories\Filters;

use App\Contracts\Abstracts\ComponentFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class MunicipalityFilter extends ComponentFactoryAbstract
{
    protected static string $entity = 'municipality';

    /**
     */
    public function make(array $params): void
    {
        $label = $params['label'] ?? trans('backpack::filters.' . self::$entity);

        CRUD::addFilter(
            [
                'type' => 'text',
                'name' => self::$entity,
                'label' => $label,
            ],
            false,
            function ($value) {
                CRUD::addClause('whereHas', 'municipality', function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%');
                });
            }
        );
    }
}
