<?php

declare(strict_types=1);

namespace App;

class Creature
{
    //base stats
    private int $strength = 0;
    private int $speed = 0;
    private int $vitality = 0;
    //derived stats
    private int $hitpoints = 0;
    private int $currentHitpoints = 0;
    private int $bonusMaxHP = 0;
    //fatigue is the number of combat turns a creatre can fight before giving up (due to fatigue), based on Speed attribute
    private int $fatigue = 0;
    //monster or player level
    private int $level = 1;
    //equipment
    public Weapon $weapon;
    public Shield $shield;
    public Armour $armour;
    //currently not in use. Dmg Red values are read directly from items that contribute to the total.
    private int $damageReduction = 0;
    //array containing creature skills and their values.
    private array $skills = [];

    //Construct and initialize a new player hero with some base values.
    public function __construct(public string $name)
    {
        $this->addSkill(new Skill("Swords", 0));
        $this->addSkill(new Skill("Axes", 0));
        $this->addSkill(new Skill("Spears", 0));
        $this->addSkill(new Skill("Hammers", 0));
        $this->addSkill(new Skill("Daggers", 0));
        $this->addSkill(new Skill("Evasion", 0));
        $this->addSkill(new Skill("Initiative", 0));
        $this->addSkill(new Skill("Block", 0));
    }

    //get player Max Hitpoints
    public function getHP(): int
    {
        $this->hitpoints = (int) floor(($this->vitality * 1) + ($this->strength * 0.4)) + $this->getBonusMaxHP();
        return $this->hitpoints;
    }

    public function setCurrentHP(int $value): void
    {
        if ($this->currentHitpoints + $value > $this->getHP()) {
            $this->currentHitpoints = $this->getHP();
        } else {
            $this->currentHitpoints = $value;
        }
    }

    public function getCurrentHP(): int
    {
        return $this->currentHitpoints;
    }

    //bonus HP is aquired for example via trinkets.
    public function setBonusMaxHP(int $value): void
    {
        $this->bonusMaxHP += $value;
    }

    public function getBonusMaxHP(): int
    {
        return $this->bonusMaxHP;
    }

    public function setFatigue(): void
    {
        $this->fatigue = (int) floor(5 + ($this->speed * 0.5));
    }

    public function getFatigue(): int
    {
        return $this->fatigue;
    }

    //xp
    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $newlevel): void
    {
        $this->level = $newlevel;
    }

    /* Handling of creature skills */

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

    public function getTotalWeight(): int
    {
        $weight = $this->weapon->weight + $this->armour->weight + $this->shield->weight;
        return $weight;
    }

    //added to Evasion, Ini and Block totals in Combat Logic.php
    public function getWeightModifier(): int
    {
        $modifier = (int) floor($this->getTotalWeight() / 2);

        return $modifier;
    }

    /* Stats and modified skill values. Always use get functions for Eva, ini and block */

    public function getEvasion(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Evasion") {
                $evasion = $skill->value + $this->speedBonus();
                if ($evasion < 0) {
                    $evasion = 0;
                }
            }
        }
        return $evasion;
    }

    public function getInitiative(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Initiative") {
                $initiative = $skill->value + $this->speedBonus();
                if ($initiative < 0) {
                    $initiative = 0;
                }
            }
        }
        return $initiative;
    }

    public function getBlock(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Block") {
                $block = $skill->value + $this->speedBonus();
                if ($block < 0) {
                    $block = 0;
                }
            }
        }
        return $block;
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

    //Speed also affects Initiative and Evasion at 20% of its value. This is kept separate from the skills base value.
    //The reason being to make sure it's not applied twice by mistake.
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

    //set + get dmgRed is currently not used. Values gotten directly from Item object(s)

    public function setDmgReduction(int $value): void
    {
        $this->damageReduction = $value;
    }

    public function getDmgReduction(): int
    {
        return $this->damageReduction;
    }

    //+++ Combat +++

    //initial damage calculation
    public function doDamage(): int
    {
        $strengthBonus = (int) floor($this->getStrength() / 10);
        $weaponDamage = rand($this->weapon->minDamage, $this->weapon->maxDamage);
        $damage = $weaponDamage + $strengthBonus;
        return $damage;
    }

    public function sufferDamage(int $damage): int
    {
        $this->currentHitpoints -= $damage;
        return $damage;
    }

    //Gets the skill value that matches equipped Weapon type. Otherwise uses Strength + Speed value instead of weapon skill.
    public function toHitChance(): int
    {
        $unarmed = $this->getStrength() + $this->getSpeed();
        foreach ($this->skills as $skill) {
            if ($skill->name === $this->weapon->type) {
                return $skill->value;
            }
        }
        return $unarmed;
    }

    public function canBlock(): bool
    {
        if (isset($this->shield) && $this->shield !== "None") {
            return true;
        } else {
            return false;
        }
    }

    public function isDead(): bool
    {
        if ($this->currentHitpoints <= 0) {
            return true;
        }

        return false;
    }
}
