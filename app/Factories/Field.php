<?php

declare(strict_types=1);

namespace App\Factories;

use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use InvalidArgumentException;

class Field
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

        return backpack_user()->can('view ' . $controller . ' field ' . $entity);
    }

    /**
     * Creates a CrudField or CrudPanel instance for the given entity.
     *
     * @param  string                   $entity the entity name
     * @param  array                    $params optional parameters
     * @throws InvalidArgumentException if the factory field is not found for the entity
     * @return CrudField|CrudPanel|null the created instance or null if permission is not granted
     */
    public static function make(string $entity, array $params = []): CrudField|CrudPanel|null
    {
        if (! self::hasPermission($entity)) {
            return null;
        }

        self::$factories = config('fields.factories');

        if (! isset(self::$factories[$entity])) {
            throw new InvalidArgumentException("Factory field not found for the entity: $entity");
        }

        $factoryClass = self::$factories[$entity];
        $factory = new $factoryClass();

        return $factory->make($params);
    }
}
