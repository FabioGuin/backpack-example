<?php

declare(strict_types=1);

namespace App\Contracts\Abstracts;

use App\Models\User;
use Backpack\CRUD\app\Library\CrudPanel\CrudColumn;
use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @method CrudPanel createUserField(User $user)
 * @method CrudPanel createDefaultField(string $label, array $params)
 */
abstract class ComponentWithRoleHandlingFactoryAbstract
{
    abstract public function make(array $params): CrudField|CrudPanel|CrudColumn|null;

    /**
     * Handle role-based behavior.
     *
     * @param User|Authenticatable|null $user   the user object
     * @param string                    $label  the label
     * @param array                     $params the parameters
     */
    protected function handleRoleBasedBehavior(User|Authenticatable|null $user, string $label, array $params): CrudField|CrudPanel|CrudColumn
    {
        if ($user->hasRole('user')) {
            return $this->createUserField($user);
        } else {
            return $this->createDefaultField($label, $params);
        }
    }
}
