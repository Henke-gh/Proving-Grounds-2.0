<?php

declare(strict_types=1);

namespace App;

//Monster creation. Borrows a lot of its structure from the Hero class. The skill "Accuracy" replaces
//the players individual weapon skills.
class Monster

{
    private int $currentHitpoints;
    private array $skills = [];
    private int $damageReduction;
    private string $description;

    public function __construct(
        public string $name,
        public int $level,
        public int $hitpoints,
        public int $xpReward,
        public Weapon $weapon
    ) {
        $this->addSkill(new Skill("Accuracy", 0));
        $this->addSkill(new Skill("Evasion", 0));
        $this->addSkill(new Skill("Initiative", 0));
        $this->addSkill(new Skill("Block", 0));
        $this->setCurrentHP($this->getHP());
    }

    public function getHP(): int
    {
        return $this->hitpoints;
    }

    public function getCurrentHP(): int
    {
        return $this->currentHitpoints;
    }

    public function setCurrentHP(int $value): void
    {
        $this->currentHitpoints = $value;
    }

    public function updateCurrentHP(int $damageTaken): int
    {
        $this->currentHitpoints -= $damageTaken;
        return $this->currentHitpoints;
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
                $evasion = $skill->value;
            }
        }
        return $evasion;
    }

    public function getInitiative(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Initiative") {
                $initiative = $skill->value;
            }
        }
        return $initiative;
    }

    public function setDmgReduction(int $value): void
    {
        $this->damageReduction = $value;
    }

    public function getDmgReduction(): int
    {
        return $this->damageReduction;
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

    public function doDamage(): int
    {
        $damage = rand($this->weapon->minDamage, $this->weapon->maxDamage);
        return $damage;
    }

    public function toHitChance(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Accuracy") {
                return $skill->value;
            }
        }
    }

    public function sufferDamage(int $damage): int
    {
        $this->currentHitpoints -= $damage;
        return $damage;
    }
    //Gold reward should perhaps not be as random but instead weighted based on performance.
    //Could take a modifier value based on player hits dealt vs. hits taken.
    public function dropGold(): int
    {
        $gold = (int) rand($this->level * 5, $this->level * 10);
        return $gold;
    }
}
