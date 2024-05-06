<?php

declare(strict_types=1);

namespace App\Contracts\Abstracts;

abstract class ComponentFactoryAbstract
{
    /**
     * Define an abstract function to make something based on the provided parameters.
     *
     * @param array $params The parameters for making something
     */
    abstract public function make(array $params): void;
}
