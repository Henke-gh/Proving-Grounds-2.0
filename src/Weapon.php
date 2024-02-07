<?php

declare(strict_types=1);

namespace App;

class Weapon extends Item
{
    public function __construct(
        string $name,
        string $type,
        int $cost,
        int $skillRequirement,
        public int $minDamage,
        public int $maxDamage,
        int $weight
    ) {
        parent::__construct($name, $type, $cost, $skillRequirement, $weight);
    }
}
