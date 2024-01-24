<?php

declare(strict_types=1);

namespace App;

//Player hero class
class Hero
{
    //base values upon Character Creation.

    //base stats
    private int $strength = 10;
    private int $speed = 10;
    private int $vitality = 10;
    //base derived stats
    private int $hitpoints = 0;
    private int $currentHitpoints = 0;
    private int $grit = 100;
    private int $currentGrit = 0;
    //fatigue is the number of combat turns the player hero can fight before giving up (due to fatigue)
    private int $fatigue = 0;
    private int $xp = 0;
    private int $gold = 0;
    public Weapon $weapon;
    //array containing player skills and their values.
    private array $skills = [];
    private array $inventory = []; //Not implemented!

    //Construct and initialize a new player hero with some base values.
    public function __construct(public string $name, public string $gender)
    {
        $this->setCurrentHP($this->getHP());
        $this->setCurrentGrit($this->getGrit());
        $this->setFatigue();
        $this->setStartingGold(125);
        $this->weapon = new Weapon("Fists", "Unarmed", 1, 2);
    }

    //get player Max Hitpoints
    public function getHP(): int
    {
        $this->hitpoints = (int) floor(($this->vitality * 1.5) + ($this->strength * 0.5));
        return $this->hitpoints;
    }

    public function setCurrentHP(int $value): void
    {
        $this->currentHitpoints += $value;
    }

    public function getCurrentHP(): int
    {
        return $this->currentHitpoints;
    }

    public function updateCurrentHP(int $damageTaken): void
    {
        $this->currentHitpoints -= $damageTaken;
    }

    public function getGrit(): int
    {
        return $this->grit;
    }

    public function getCurrentGrit(): int
    {
        return $this->currentGrit;
    }

    public function setCurrentGrit(int $value): void
    {
        $this->currentGrit += $value;
    }

    public function updateCurrentGrit(int $gritSpent): int
    {
        $this->currentGrit -= $gritSpent;
        return $this->currentGrit;
    }

    public function setFatigue(): void
    {
        $this->fatigue = (int) floor(5 + ($this->speed * 0.5));
    }

    public function getFatigue(): int
    {
        return $this->fatigue;
    }

    public function setStartingGold(int $value): void
    {
        $this->gold = $value;
    }

    public function getGold(): int
    {
        return $this->gold;
    }

    public function getXP(): int
    {
        return $this->xp;
    }

    public function updateXP(int $xpValue): int
    {
        $this->xp += $xpValue;
        return $this->xp;
    }

    public function addSkill(Skill $skill): void
    {
        $this->skills[] = $skill;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }
}
