<?php

declare(strict_types=1);

namespace App;

//Monster creation.
class Monster extends Creature

{
    private string $description;

    public function __construct(
        string $name,
        public int $xpReward,
    ) {
        parent::__construct($name);
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    //+++ Combat +++

    //Gold reward should perhaps not be as random but instead weighted based on performance.
    //Could take a modifier value based on player hits dealt vs. hits taken.
    public function dropGold(): int
    {
        $gold = (int) rand($this->getLevel() * 5, $this->getLevel() * 10);
        if ($gold > 30) {
            $gold = rand(15, 30);
        }
        return $gold;
    }
}
