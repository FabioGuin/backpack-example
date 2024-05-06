<?php

declare(strict_types=1);

namespace App\Factories;

use Backpack\CRUD\app\Library\CrudPanel\CrudColumn;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use InvalidArgumentException;

class Column
{
    protected static array $factories;

    /**
     * Check if the user has permission to view a column.
     *
     * @param  string $entity the entity for which the column permission is being checked
     * @return bool   returns true if the user has permission, false otherwise
     */
    protected static function hasPermission(string $entity): bool
    {
        $entity = str_replace('_', ' ', $entity);
        $controller = app('getControllerName');
        //info('view ' . $controller . ' column ' . $entity);

        return backpack_user()->can('view ' . $controller . ' column ' . $entity);
    }

    /**
     * Create a new CrudColumn or CrudPanel instance.
     *
     * @param  string                    $entity the entity for which to create the instance
     * @param  array                     $params the parameters to pass to the instance
     * @throws InvalidArgumentException  if the factory column for the entity is not found
     * @return CrudColumn|CrudPanel|null the created instance
     */
    public static function make(string $entity, array $params = []): CrudColumn|CrudPanel|null
    {
        if (! self::hasPermission($entity)) {
            return null;
        }

        self::$factories = config('columns.factories');

        if (! isset(self::$factories[$entity])) {
            throw new InvalidArgumentException("Factory column not found for entity: $entity");
        }

        $factoryClass = self::$factories[$entity];
        $factory = new $factoryClass();

        return $factory->make($params);
    }
}
