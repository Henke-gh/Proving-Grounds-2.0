<?php

declare(strict_types=1);

namespace App;

class Shield
{
    private int $evasion = 0;
    private int $initiative = 0;
    private int $block = 0;
    private string $description = "None available.";

    public function __construct(
        public string $name,
        public string $type,
        public int $skillRequirement,
        public int $damageReduction,
        public int $weight,
        public int $cost
    ) {
    }

    //Use the set-functions to apply corresponding bonus to weapon item.
    public function setEvasionBonus(int $value): void
    {
        $this->evasion = $value;
    }

    public function setInitiativeBonus(int $value): void
    {
        $this->initiative = $value;
    }

    public function setBlockBonus(int $value): void
    {
        $this->block = $value;
    }

    public function getEvasionBonus(): int
    {
        return $this->evasion;
    }

    public function getInitiativeBonus(): int
    {
        return $this->initiative;
    }

    public function getBlockBonus(): int
    {
        return $this->block;
    }

    public function setItemDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getItemDescription(): string
    {
        return $this->description;
    }
}
