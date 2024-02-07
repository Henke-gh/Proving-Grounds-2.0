<?php

declare(strict_types=1);

namespace App;

class Shield extends Item
{
    public function __construct(
        string $name,
        string $type,
        int $cost,
        int $skillRequirement,
        public int $damageReduction,
        int $weight,
    ) {
        parent::__construct($name, $type, $cost, $skillRequirement, $weight);
    }
}
