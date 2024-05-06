<?php

declare(strict_types=1);

namespace App\Factories;

use InvalidArgumentException;

class Filter
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

        return backpack_user()->can('view ' . $controller . ' filter ' . $entity);
    }

    /**
     * Creates an instance of a factory for the given entity.
     *
     * @param  string                   $entity the entity for which to create the factory
     * @param  array                    $params optional parameters for the factory
     * @throws InvalidArgumentException if the factory for the entity is not found
     */
    public static function make(string $entity, array $params = []): void
    {
        if (! self::hasPermission($entity)) {
            return;
        }

        self::$factories = config('filters.factories');

        if (! isset(self::$factories[$entity])) {
            throw new InvalidArgumentException("Factory filter not found for entity: $entity");
        }

        $factoryClass = self::$factories[$entity];
        $factory = new $factoryClass();

        $factory->make($params);
    }
}
