<?php

declare(strict_types=1);

namespace App\Factories\Filters;

use App\Contracts\Abstracts\ComponentFactoryAbstract;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CreatedAtFilter extends ComponentFactoryAbstract
{
    protected static string $entity = 'created_at';

    /**
     */
    public function make(array $params): void
    {
        $label = $params['label'] ?? trans('backpack::filters.' . self::$entity);
        $table = $params['table'] ?? null;

        CRUD::addFilter(
            [
                'type' => 'date_range',
                'name' => self::$entity,
                'label' => $label,
            ],
            false,
            function ($value) use ($table) {
                $dates = json_decode($value);
                if (isset($dates->from) && isset($dates->to)) {
                    $tableColumn = $table !== null ? $table . '.' . self::$entity : self::$entity;
                    CRUD::addClause('where', $tableColumn, '>=', $dates->from);
                    CRUD::addClause('where', $tableColumn, '<=', $dates->to . ' 23:59:59');
                }
            }
        );
    }
}
