<?php

declare(strict_types=1);

namespace App\Factories\Filters;

use App\Contracts\Abstracts\ComponentFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class AddressFilter extends ComponentFactoryAbstract
{
    protected static string $entity = 'address';

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
                CRUD::addClause('where', self::$entity, 'LIKE', "%$value%");
            }
        );
    }
}
