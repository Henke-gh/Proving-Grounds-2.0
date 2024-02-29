<?php

declare(strict_types=1);

namespace App;

//Player hero class
class Hero extends Creature
{
    //base values upon Character Creation.
    private int $grit = 115;
    private int $gold = 0;
    //base derived stats
    private int $currentGrit = 0;
    //regeneration of HP and Grit
    private int $regenRateHP = 0;
    private int $regenRateGrit = 12;
    private int $lastRegeneration = 0;
    //fame and xp values, used to calculate when (and what) to level up player hero
    private int $xp = 0;
    private int $xpToNextLvl = 75;
    private int $fameLevel = 0;
    private int $fameScore = 0;
    private int $nextFameLvl = 10;
    private string $fameTitle = "Novice";
    //keeps track of player win-rate
    private int $wins = 0;
    private int $losses = 0;
    //items
    private array $trinkets = [];
    //player bought items not currently equipped are kept here
    private array $inventory = [
        'weapons' => [],
        'shields' => [],
        'armours' => [],
        'trinkets' => []
    ];
    //is set during hero creation
    private string $avatarURL = "none";

    //Construct and initialize a new player hero with some base values.
    public function __construct(string $name, public string $gender)
    {
        parent::__construct($name);
        $this->setCurrentHP($this->getHP());
        $this->setFatigue();
        $this->setCurrentGrit($this->getGrit());
        $this->setRegenHP();
        $this->setGold(125);
    }

    public function setAvatar(string $url): void
    {
        $this->avatarURL = $url;
    }

    public function getAvatar(): string
    {
        return $this->avatarURL;
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
        $this->currentGrit = $value;

        if ($this->currentGrit > 115) {
            $this->currentGrit = 115;
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

    /* Hp and Grit regeneration */

    public function setLastRegen(int $time): void
    {
        $this->lastRegeneration = $time;
    }

    public function getLastRegen(): int
    {
        return $this->lastRegeneration;
    }

    public function setRegenHP(): void
    {
        $value = (int) floor($this->getHP() / 3);
        $this->regenRateHP = $value;
    }

    public function getRegenHP(): int
    {
        return $this->regenRateHP;
    }

    public function setRegenGrit(int $value): void
    {
        $this->regenRateGrit = $value;
    }

    public function getRegenGrit(): int
    {
        return $this->regenRateGrit;
    }

    public function regenerateHPnGrit(): void
    {
        $currentTime = time();
        $lastRegen = $this->getLastRegen();
        $elapsedTime = $currentTime - $lastRegen;
        $hpAmount = (int) floor($elapsedTime / 180) * $this->getRegenHP();
        $gritAmount = (int) floor($elapsedTime / 180) * $this->getRegenGrit();
        //if 180 or more seconds since last hp and grit update, do update
        if ($elapsedTime >= 180) {
            $this->setCurrentHP($this->getCurrentHP() + $hpAmount);
            $this->setCurrentGrit($this->getCurrentGrit() + $gritAmount);
            $this->setLastRegen($currentTime);
        }
    }

    public function setGold(int $value): void
    {
        $this->gold = $value;
    }

    public function getGold(): int
    {
        return $this->gold;
    }

    /* Level Up */
    //xp
    public function getXP(): int
    {
        return $this->xp;
    }

    public function setXP(int $xpValue): void
    {
        $this->xp = $xpValue;
    }

    public function getXPtoNext(): int
    {
        return $this->xpToNextLvl;
    }

    public function setXPtoNext(int $xpReq): void
    {
        $this->xpToNextLvl = $xpReq;
    }

    //fame
    public function setFameLevel(int $fameLevel): void
    {
        $this->fameLevel = $fameLevel;
    }

    public function getFameLevel(): int
    {
        return $this->fameLevel;
    }

    public function setFameScore(int $fameScore): void
    {
        $this->fameScore = $fameScore;
    }

    public function getFameScore(): int
    {
        return $this->fameScore;
    }

    public function setFameToNext(int $fameToNext): void
    {
        $this->nextFameLvl = $fameToNext;
    }

    public function getFameToNext(): int
    {
        return $this->nextFameLvl;
    }

    public function setFameTitle(string $fameTitle): void
    {
        $this->fameTitle = $fameTitle;
    }

    public function getFameTitle(): string
    {
        return $this->fameTitle;
    }

    /* Inventory and Item management */

    public function getTrinkets(): array
    {
        return $this->trinkets;
    }

    public function setTrinkets(array $trinkets): void
    {
        $this->trinkets = $trinkets;
    }

    public function addTrinket(Trinket $item): void
    {
        $this->trinkets[] = $item;
    }

    public function removeTrinket(Trinket $item): void
    {
        // Search for the index of the trinket in the array
        $index = array_search($item, $this->trinkets, true);

        // Check if the trinket was found
        if ($index !== false) {
            unset($this->trinkets[$index]);
        }
    }

    public function getInventory(): array
    {
        return $this->inventory;
    }
    //Rework these to one general addInv function!!
    public function addInventoryWeapon(Weapon $item): void
    {
        $this->inventory['weapons'][] = $item;
    }

    public function addInventoryShield(Shield $item): void
    {
        $this->inventory['shields'][] = $item;
    }

    public function addInventoryArmour(Armour $item): void
    {
        $this->inventory['armours'][] = $item;
    }

    public function addInventoryTrinket(Trinket $item): void
    {
        $this->inventory['trinkets'][] = $item;
    }

    public function removeInventoryItem(Item $item, string $itemType): void
    {
        $inventory = $this->getInventory();
        $itemToRemove = array_search($item, $inventory[$itemType]);

        if ($itemToRemove !== false) {
            unset($inventory[$itemType][$itemToRemove]);
        }

        $this->setInventory($inventory);
    }


    public function setInventory(array $inventory): void
    {
        $this->inventory = $inventory;
    }

    //++++ Methods related to saving/ loading player data +++++

    //this is used to store player data in a $_SESSION-variable. Used for saving player progress between pages and
    //saving player progress to database.
    public function saveHeroState(): array
    {
        $heroSaveState = [
            'name' => $this->name,
            'gender' => $this->gender,
            'level' => $this->getLevel(),
            'bonusMaxHP' => $this->getBonusMaxHP(),
            'hitpoints' => $this->getHP(),
            'currentHitpoints' => $this->getCurrentHP(),
            'grit' => $this->getGrit(),
            'currentGrit' => $this->getCurrentGrit(),
            'lastRegen' => $this->getLastRegen(),
            'gritRegenRate' => $this->getRegenGrit(),
            'fatigue' => $this->getFatigue(),
            'gold' => $this->getGold(),
            'xp' => $this->getXP(),
            'xpToNext' => $this->getXPtoNext(),
            'strength' => $this->getStrength(),
            'speed' => $this->getSpeed(),
            'vitality' => $this->getVitality(),
            'weapon' => $this->weapon,
            'shield' => $this->shield,
            'armour' => $this->armour,
            'trinkets' => $this->getTrinkets(),
            'skills' => $this->getSkills(),
            'inventory' => $this->getInventory(),
            'avatar' => $this->getAvatar(),
            'wins' => $this->getWins(),
            'losses' => $this->getLosses(),
            'fameTitle' => $this->getFameTitle(),
            'fameScore' => $this->getFameScore(),
            'fameLevel' => $this->getFameLevel(),
            'fameToNext' => $this->getFameToNext()
        ];

        return $heroSaveState;
    }

    //Run this to "repopulate" a Hero instance with saved player data.
    public function loadHeroState(array $player): void
    {
        $this->setStrength($player['strength']);
        $this->setSpeed($player['speed']);
        $this->setVitality($player['vitality']);
        $this->setBonusMaxHP($player['bonusMaxHP']);
        $this->getHP();
        $this->getGrit();
        $this->setLastRegen($player['lastRegen']);
        $this->setRegenGrit($player['gritRegenRate']);
        $this->setRegenHP();
        $this->setFatigue();
        $this->setCurrentHP($player['currentHitpoints']);
        $this->setCurrentGrit($player['currentGrit']);
        $this->setGold($player['gold']);
        $this->setXP($player['xp']);
        $this->setXPtoNext($player['xpToNext']);
        $this->setLevel($player['level']);
        $this->weapon = $player['weapon'];
        $this->shield = $player['shield'];
        $this->armour = $player['armour'];
        $this->setAvatar($player['avatar']);
        $this->setWins($player['wins']);
        $this->setLosses($player['losses']);
        $this->setFameLevel($player['fameLevel']);
        $this->setFameScore($player['fameScore']);
        $this->setFameTitle($player['fameTitle']);
        $this->setFameToNext($player['fameToNext']);
        $this->setInventory($player['inventory']);

        foreach ($player['skills'] as $skill) {
            $this->setSkill($skill->name, $skill->value);
        }

        if (!empty($player['trinkets'])) {
            foreach ($player['trinkets'] as $trinket) {
                $this->addTrinket($trinket);
            }
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

    /* Used to update player combat statistics and win-rate */

    public function setWins(int $addWin): void
    {
        $this->wins += $addWin;
    }

    public function getWins(): int
    {
        return $this->wins;
    }

    public function setLosses(int $addLoss): void
    {
        $this->losses += $addLoss;
    }

    public function getLosses(): int
    {
        return $this->losses;
    }

    public function getTotalFights(): int
    {
        $totalFights = $this->getWins() + $this->getLosses();
        return $totalFights;
    }

    public function getWinLossRatio(): string
    {
        $totalFights = $this->getWins() + $this->getLosses();

        if ($totalFights <= 0) {
            return "0";
        }

        $percentageWins = $this->getWins() / $totalFights * 100;
        $format_percentageWins = number_format($percentageWins, 0);
        return $format_percentageWins;
    }
}
