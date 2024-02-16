<?php

declare(strict_types=1);

namespace App;

class Armour extends Item
{
    public function __construct(
        string $name,
        string $type,
        int $cost,
        int $skillRequirement,
        int $weight
    ) {
        parent::__construct($name, $type, $cost, $skillRequirement, $weight);
    }
}
