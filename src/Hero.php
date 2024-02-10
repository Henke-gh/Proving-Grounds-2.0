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
    private int $grit = 115;
    private int $currentGrit = 0;
    //fatigue is the number of combat turns the player hero can fight before giving up (due to fatigue)
    private int $fatigue = 0;
    private int $level = 1;
    private int $xp = 0;
    private int $xpToNextLvl = 200;
    private int $gold = 0;
    private int $wins = 0;
    private int $losses = 0;
    public Weapon $weapon;
    public Shield $shield;
    public Armour $armour;
    public Trinket $trinketSlot1;
    public Trinket $trinketSlot2;
    public Trinket $trinketSlot3;
    private int $damageReduction = 0;
    //array containing player skills and their values.
    private array $skills = [];
    private array $inventory = [
        'weapons' => [],
        'shields' => [],
        'armours' => [],
        'trinkets' => []
    ];
    private string $avatarURL = "none";

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
        $this->weapon = new Weapon("Fists", "Unarmed", 0, 0, 1, 2, 0);
        $this->weapon->setItemDescription("They're your flesh mittens, champ. Might wanna invest in something for them to swing.");
        $this->shield = new Shield("None", "Shield", 0, 100, 0);
        $this->shield->setItemDescription("It's really not ideal but you could probably deflect a blow or two with your elbow.");
        $this->armour = new Armour("Tunic", "Armour", 0, 0, 0);
        $this->armour->setDmgReduction(0);
        $this->armour->setItemDescription("The merchant said it\s a nice tunic. Looks more like rags to you.");
    }

    public function setAvatar(string $url): void
    {
        $this->avatarURL = $url;
    }

    public function getAvatar(): string
    {
        return $this->avatarURL;
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
            $this->currentHitpoints = $value;
        }
    }

    public function getCurrentHP(): int
    {
        return $this->currentHitpoints;
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

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $newlevel): void
    {
        $this->level = $newlevel;
    }

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

    public function getInventory(): array
    {
        return $this->inventory;
    }

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

    public function removeInventoryWeapon(Weapon $item): void
    {
        if (in_array($item, $this->getInventory())) {
            unset($item);
        }
    }

    public function getTotalWeight(): int
    {
        $weight = $this->weapon->weight + $this->armour->weight + $this->shield->weight;
        return $weight;
    }

    public function getEvasion(): int
    {
        foreach ($this->skills as $skill) {
            if ($skill->name === "Evasion") {
                $evasion = (int) floor($skill->value + $this->speedBonus() - $this->getTotalWeight() / 2);
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
                $initiative = (int) floor($skill->value + $this->speedBonus() - $this->getTotalWeight() / 2);
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
                $block = (int) floor($skill->value + $this->speedBonus() - $this->getTotalWeight() / 2);
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

    public function setDmgReduction(int $value): void
    {
        $this->damageReduction = $value;
    }

    public function getDmgReduction(): int
    {
        return $this->damageReduction;
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
            'hitpoints' => $this->getHP(),
            'currentHitpoints' => $this->getCurrentHP(),
            'grit' => $this->getGrit(),
            'currentGrit' => $this->getCurrentGrit(),
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
            'skills' => $this->getSkills(),
            'inventory' => $this->getInventory(),
            'avatar' => $this->getAvatar(),
            'wins' => $this->getWins(),
            'losses' => $this->getLosses()
        ];

        if (isset($this->trinketSlot1)) {
            $heroSaveState = [
                'trinket1' => $this->trinketSlot1
            ];
        }
        if (isset($this->trinketSlot2)) {
            $heroSaveState = [
                'trinket2' => $this->trinketSlot2
            ];
        }
        if (isset($this->trinketSlot3)) {
            $heroSaveState = [
                'trinket3' => $this->trinketSlot3
            ];
        }

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
        $this->setXP($player['xp']);
        $this->setXPtoNext($player['xpToNext']);
        $this->setLevel($player['level']);
        $this->weapon = $player['weapon'];
        $this->shield = $player['shield'];
        $this->armour = $player['armour'];
        $this->setAvatar($player['avatar']);
        $this->setWins($player['wins']);
        $this->setLosses($player['losses']);

        foreach ($player['skills'] as $skill) {
            $this->setSkill($skill->name, $skill->value);
        }

        foreach ($player['inventory'] as $category => $items) {
            foreach ($items as $item) {
                switch ($item->type) {
                    case 'Shield':
                        $this->addInventoryShield($item);
                        break;
                    case 'Armour':
                        $this->addInventoryArmour($item);
                        break;
                    case 'Trinket':
                        # code...
                        break;

                    default:
                        $this->addInventoryWeapon($item);
                        break;
                }
            }
        }

        if (array_key_exists('trinket1', $player)) {
            $this->trinketSlot1 = $player['trinket1'];
        }
        if (array_key_exists('trinket2', $player)) {
            $this->trinketSlot2 = $player['trinket2'];
        }
        if (array_key_exists('trinket3', $player)) {
            $this->trinketSlot3 = $player['trinket3'];
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
