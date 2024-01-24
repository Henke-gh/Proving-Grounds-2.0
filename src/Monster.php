<?php

declare(strict_types=1);

namespace App;

class Monster
{
    private int $currentHitpoints;

    public function __construct(
        public string $name,
        public int $level,
        public int $hitpoints,
        public int $xp,
        public Weapon $weapon
    ) {
    }

    public function getHP(): int
    {
        return $this->hitpoints;
    }

    public function getCurrentHP(): int
    {
        return $this->currentHitpoints;
    }

    public function updateCurrentHP(int $damageTaken): int
    {
        $this->currentHitpoints -= $damageTaken;
        return $this->currentHitpoints;
    }
}
