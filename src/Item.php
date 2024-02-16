<?php

declare(strict_types=1);

namespace App;

class Item
{
    private int $evasion = 0;
    private int $initiative = 0;
    private int $block = 0;
    private int $damageReduction = 0;
    private int $maxHP = 0;
    private string $description = "None available.";

    public function __construct(
        public string $name,
        public string $type,
        public int $cost,
        public int $skillRequirement,
        public int $weight
    ) {
    }

    //Use the set-functions to apply corresponding bonus to item.
    public function setDmgReduction(int $DRvalue): void
    {
        $this->damageReduction = $DRvalue;
    }

    public function getDmgReduction(): int
    {
        return $this->damageReduction;
    }

    public function setMaxHP(int $incMaxHP): void
    {
        $this->maxHP = $incMaxHP;
    }

    public function getMaxHP(): int
    {
        return $this->maxHP;
    }

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

    public function addToArmory(array &$itemType): void
    {
        $itemType[] = $this;
    }

    public function applyBonuses(Hero $player): void
    {
        $bonusBlock = $this->getBlockBonus();
        $bonusEvasion = $this->getEvasionBonus();
        $bonusInitiative = $this->getInitiativeBonus();
        $bonusHP = $this->getMaxHP();
        $bonusDmgRed = $this->getDmgReduction();

        if ($bonusBlock > 0) {
            $player->setSkill("Block", $bonusBlock);
        }
        if ($bonusEvasion > 0) {
            $player->setSkill("Evasion", $bonusEvasion);
        }
        if ($bonusInitiative > 0) {
            $player->setSkill("Initiative", $bonusInitiative);
        }
        if ($bonusHP > 0) {
            $player->setBonusMaxHP(+$bonusHP);
        }
        if ($bonusDmgRed > 0) {
            $currentDmgRed = $player->getDmgReduction();
            $player->setDmgReduction($currentDmgRed + $bonusDmgRed);
        }
    }

    public function removeBonuses(Hero $player): void
    {
        $bonusBlock = $this->getBlockBonus();
        $bonusEvasion = $this->getEvasionBonus();
        $bonusInitiative = $this->getInitiativeBonus();
        $bonusHP = $this->getMaxHP();
        $bonusDmgRed = $this->getDmgReduction();


        if ($bonusBlock > 0) {
            $player->setSkill("Block", -$bonusBlock);
        }
        if ($bonusEvasion > 0) {
            $player->setSkill("Evasion", -$bonusEvasion);
        }
        if ($bonusInitiative > 0) {
            $player->setSkill("Initiative", -$bonusInitiative);
        }
        if ($bonusHP > 0) {
            $player->setBonusMaxHP(-$bonusHP);
        }
        if ($bonusDmgRed > 0) {
            $currentDmgRed = $player->getDmgReduction();
            $player->setDmgReduction(- ($currentDmgRed - $bonusDmgRed));
        }
    }
}
