<?php

declare(strict_types=1);

namespace App\Factories\Filters;

use App\Contracts\Abstracts\ComponentFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class LatitudeFilter extends ComponentFactoryAbstract
{
    protected static string $entity = 'latitude';

    /**
     */
    public function make(array $params): void
    {
        $label = $params['label'] ?? trans('backpack::filters.' . self::$entity);

        CRUD::addFilter(
            [
                'name' => self::$entity,
                'type' => 'range',
                'label' => $label,
                'label_from' => trans('backpack::filters.label_from'),
                'label_to' => trans('backpack::filters.label_to'),
            ],
            false,
            function ($value) {
                $range = json_decode($value);
                if ($range->from) {
                    CRUD::addClause('where', self::$entity, '>=', (float) $range->from);
                }
                if ($range->to) {
                    CRUD::addClause('where', self::$entity, '<=', (float) $range->to);
                }
                CRUD::orderBy(self::$entity);
            }
        );
    }
}
