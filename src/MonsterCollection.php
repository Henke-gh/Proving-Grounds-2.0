<?php

declare(strict_types=1);

namespace App;

use App\Monster;

class MonsterCollection
{
    private array $monsters = [];
    public function __construct()
    {
    }

    public function getMonster(int $monsterID): Monster
    {
        $monsterIndex = 0;
        foreach ($this->monsters as $monster) {
            if ($monsterIndex === $monsterID) {
                return $monster;
            }
            $monsterIndex++;
        }
    }

    public function addMonster(Monster $monster): void
    {
        $this->monsters[] = $monster;
    }

    public function getAllMonsters(): array
    {
        return $this->monsters;
    }
}
