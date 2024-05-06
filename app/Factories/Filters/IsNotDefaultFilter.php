<?php

declare(strict_types=1);

namespace App\Factories\Filters;

use App\Contracts\Abstracts\ComponentFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class IsNotDefaultFilter extends ComponentFactoryAbstract
{
    protected static string $entity = 'is_not_default';

    /**
     */
    public function make(array $params): void
    {
        $label = $params['label'] ?? trans('backpack::filters.' . self::$entity);

        CRUD::addFilter(
            [
                'type' => 'simple',
                'name' => self::$entity,
                'label' => $label,
            ],
            false,
            function () {
                CRUD::addClause('isNotDefault');
            }
        );
    }
}
