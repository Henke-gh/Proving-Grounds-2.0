<?php

declare(strict_types=1);

namespace App;

class Shield extends Item
{
    private int $damageReduction = 0;

    public function __construct(
        string $name,
        string $type,
        int $cost,
        int $skillRequirement,
        int $weight,
    ) {
        parent::__construct($name, $type, $cost, $skillRequirement, $weight);
    }

    public function setDmgReduction(int $DRvalue): void
    {
        $this->damageReduction = $DRvalue;
    }

    public function getDmgReduction(): int
    {
        return $this->damageReduction;
    }
}
