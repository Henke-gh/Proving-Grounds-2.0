<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/monsterLibrary.php";

use App\Hero;
use App\Monster;

//decide who acts first each round of combat. If returns true, player goes first, otherwise monster goes first.
function determineInitiative(int $playerIni, int $monsterIni): bool
{
    $playerIni = rand(0, $playerIni);
    $monsterIni = rand(0, $monsterIni);
    if ($playerIni >= $monsterIni) {
        return true;
    } else {
        return false;
    }
}

//calculate final damage, inc potential crit dmg. Takes the attackers damage value aswell as the armour value of the defender.
function determineDamage(int $attackerDamage, int $defenderArmour): int
{
    $damage = $attackerDamage - $defenderArmour;

    if ($damage < 0) {
        $damage = 0;
    }
    return $damage;
}

//Currently quite simple. Needs a rework. Base val(5 or 10 maybe) + (WeaponSkill/10) >= rand(1,100) = crit?
function critChance(): bool
{
    $critChance = rand(1, 10);
    if ($critChance === 10) {
        return true;
    } else {
        return false;
    }
}

function critDamage($attackDamage): int
{
    $damage = (int) floor($attackDamage * 1.5);
    return $damage;
}

//Takes three argument, determines if an attack hits or not. WIP!!!!
function chanceToHit(int $attackerWeaponSkill, int $attackerWeaponReq, int $defenderEvasionSkill): bool
{
    if ($attackerWeaponReq > $attackerWeaponSkill) {
        $baseHitChance = (int) floor(($attackerWeaponSkill * 0.5) - $defenderEvasionSkill / 2);
    } else {
        $baseHitChance = $attackerWeaponSkill - $defenderEvasionSkill / 2;
    }

    if ($baseHitChance < rand(0, 10) + $defenderEvasionSkill) {
        return false;
    } else {
        $targetEvasion = rand(0, $defenderEvasionSkill);
        $targetAttack = rand(0, $attackerWeaponSkill);
        if ($targetAttack < $targetEvasion) {
            return false;
        } else {
            return true;
        }
    }
}

function playerAttack(Hero $player, Monster $monster): array
{
    $log = [];
    if (critChance() === true) {
        $damage = critDamage($player->doDamage());
        array_push($log, $player->name . " strikes a furious blow to " . $monster->name . " for " . $monster->sufferDamage($damage)) . "!";
    } else {
        $damage = $player->doDamage();
        if (chanceToHit($player->toHitChance(), $player->weapon->skillRequirement, $monster->toHitChance()) === true) {
            array_push($log, $monster->name . " gets hit for " . $monster->sufferDamage($damage) . ".");
        } else {
            array_push($log, $player->name . " misses..");
        }
    }

    return $log;
}

function monsterAttack(Monster $monster, Hero $player): array
{
    $log = [];
    if (critChance() === true) {
        $damage = critDamage($monster->doDamage());
        array_push($log, $monster->name . " strikes a murderous blow to " . $player->name . " for " . $player->sufferDamage($damage)) . "!";
    } else {
        $damage = $monster->doDamage();
        if (chanceToHit($monster->toHitChance(), $monster->weapon->skillRequirement, $player->getEvasion()) === true) {
            array_push($log, $player->name . " gets hit for " . $player->sufferDamage($damage));
        } else {
            array_push($log, $monster->name . " misses..");
        }
    }

    return $log;
}

function fightReward(Hero $player, int $gold, int $xpReward): void
{
    $player->setGold($player->getGold() + $gold);
    $xp = $xpReward;
    $player->setXP($player->getXP() + $xp);
}

function doBattle(Hero $player, Monster $monster, int $retreatValue): array
{
    $combatLog = [];
    $turn = 1;
    //calculate player HP value at which player gives up and combat ends.
    $retreatValue = (int) floor($retreatValue / 100 * $player->getHP());

    $goldDrop = $monster->dropGold();
    $xpReward = $monster->xpReward;

    while ($player->getCurrentHP() > $retreatValue) {
        array_push($combatLog, "Turn: " . $turn);
        //if returns true, player goes first else monster goes first.
        if (determineInitiative($player->getInitiative(), $monster->getInitiative())) {
            $lines = playerAttack($player, $monster);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($monster->getCurrentHP() <= 0) {
                array_push($combatLog, $monster->name . " is defeated!");
                array_push($combatLog, "You gain " . $xpReward . " xp and " . $goldDrop . " gold.");
                fightReward($player, $goldDrop, $xpReward);
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }

            $lines = monsterAttack($monster, $player);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($player->getCurrentHP() <= $retreatValue) {
                array_push($combatLog, $player->name . " is defeated!");
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }
        } else {
            $lines = monsterAttack($monster, $player);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($player->getCurrentHP() <= $retreatValue) {
                array_push($combatLog, $player->name . " is defeated!");
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }

            $lines = playerAttack($player, $monster);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($monster->getCurrentHP() <= 0) {
                array_push($combatLog, $monster->name . " is defeated!");
                array_push($combatLog, "You gain " . $xpReward . " xp and " . $goldDrop . " gold.");
                fightReward($player, $goldDrop, $xpReward);
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }
        }
        $turn++;

        if ($player->getFatigue() < $turn) {
            array_push($combatLog, $player->name . " collapses due to fatigue.");
            $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
        }
    }
    $_SESSION['player'] = $player->saveHeroState();
    var_dump($turn);
    return $combatLog;
}
