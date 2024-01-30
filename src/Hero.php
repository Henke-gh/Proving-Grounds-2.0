<?php

declare(strict_types=1);

namespace App;

//Player hero class
class Hero
{
    //base values upon Character Creation.

    //base stats
    private int $strength = 0;
    private int $speed = 0;
    private int $vitality = 0;
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
        $this->setGold(125);
        $this->addSkill(new Skill("Swords", 0));
        $this->addSkill(new Skill("Axes", 0));
        $this->addSkill(new Skill("Spears", 0));
        $this->addSkill(new Skill("Hammers", 0));
        $this->addSkill(new Skill("Daggers", 0));
        $this->addSkill(new Skill("Evasion", 0));
        $this->addSkill(new Skill("Initiative", 0));
        $this->addSkill(new Skill("Block", 0));
        $this->weapon = new Weapon("Fists", "Unarmed", 1, 2, 0);
        $this->weapon->setItemDescription("They're your flesh mittens, champ. Might wanna invest in something for them to swing.");
    }

    //get player Max Hitpoints
    public function getHP(): int
    {
        $this->hitpoints = (int) floor(($this->vitality * 1.5) + ($this->strength * 0.5));
        return $this->hitpoints;
    }

    public function setCurrentHP(int $value): void
    {
        if ($this->currentHitpoints + $value > $this->getHP()) {
            $this->currentHitpoints = $this->getHP();
        } else {
            $this->currentHitpoints += $value;
        }
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
        if ($this->currentGrit + $value > 100) {
            $this->currentGrit = 100;
        } else {
            $this->currentGrit += $value;
        }
    }

    public function updateCurrentGrit(int $gritSpent): int
    {
        if ($this->currentGrit - $gritSpent < 0) {
            $this->currentGrit = 0;
        } else {
            $this->currentGrit -= $gritSpent;
        }
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

    public function setGold(int $value): void
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

    public function setXP(int $xpValue): void
    {
        $this->xp += $xpValue;
    }

    public function addSkill(Skill $skill): void
    {
        $this->skills[] = $skill;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkill(string $name, int $value): void
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === $name) {
                $skill->value += $value;
            }
        }
    }

    public function getEvasion(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Evasion") {
                $evasion = $skill->value + $this->speedBonus();
            }
        }
        return $evasion;
    }

    public function getInitiative(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Initiative") {
                $initiative = $skill->value + $this->speedBonus();
            }
        }
        return $initiative;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $value): void
    {
        $this->strength += $value;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setSpeed(int $value): void
    {
        $this->speed += $value;
    }

    //Speed also affects Initiative and Evasion at 20% of its value. Here we apply that bonus.
    public function speedBonus(): int
    {
        $speedbonus = (int) floor($this->getSpeed() * 0.2);
        return $speedbonus;
    }

    public function getVitality(): int
    {
        return $this->vitality;
    }

    public function setVitality(int $value): void
    {
        $this->vitality += $value;
    }

    //++++ Methods related to saving/ loading player data +++++

    //this is used to store player data in a $_SESSION-variable. Used for saving player progress between pages and
    //saving player progress to database.
    public function saveHeroState(): array
    {
        $heroSaveState = [
            'name' => $this->name,
            'gender' => $this->gender,
            'hitpoints' => $this->getHP(),
            'currentHitpoints' => $this->getCurrentHP(),
            'grit' => $this->getGrit(),
            'currentGrit' => $this->getCurrentGrit(),
            'fatigue' => $this->getFatigue(),
            'gold' => $this->getGold(),
            'xp' => $this->getXP(),
            'strength' => $this->getStrength(),
            'speed' => $this->getSpeed(),
            'vitality' => $this->getVitality(),
            'weapon' => $this->weapon,
            'skills' => $this->getSkills(),
            //add inventory here!
        ];

        return $heroSaveState;
    }

    //Run this to "repopulate" a Hero instance with saved player data.
    public function loadHeroState(array $player): void
    {
        $this->setStrength($player['strength']);
        $this->setSpeed($player['speed']);
        $this->setVitality($player['vitality']);
        $this->getHP();
        $this->getGrit();
        $this->setFatigue();
        $this->setCurrentHP($player['currentHitpoints']);
        $this->setCurrentGrit($player['currentGrit']);
        $this->setGold($player['gold']);
        $this->weapon = $player['weapon'];

        foreach ($player['skills'] as $skill) {
            $this->setSkill($skill->name, $skill->value);
        }
    }

    //Should be used after a player has increased any stats from which other stat values are derived.
    //For example after a level up or hero creation.
    //These include Strength, Speed and Vitality.
    //Potential problem with setting currentHP and Grit to Max if player increases Base attributes outside of this context.
    public function updateDerivedStats(): void
    {
        $this->setCurrentHP($this->getHP());
        $this->setCurrentGrit($this->getGrit());
        $this->setFatigue();
    }

    //+++ Combat +++

    //initial damage calculation
    public function doDamage(): int
    {
        $strengthBonus = (int) floor($this->getStrength() * 0.2);
        $weaponDamage = rand($this->weapon->minDamage, $this->weapon->maxDamage);
        $damage = $weaponDamage + $strengthBonus;
        return $damage;
    }
}
