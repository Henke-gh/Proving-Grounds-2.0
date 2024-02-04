<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/monsterLibrary.php";

use App\Hero;
use App\Monster;

//decide who acts first each round of combat. If returns true, player goes first, otherwise monster goes first.
function determineInitiative(int $playerIni, int $monsterIni): bool
{
    if ($playerIni > $monsterIni) {
        return true;
    } else {
        return false;
    }
}

//calculate final damage, inc potential crit dmg. Takes the attackers damage value aswell as the armour value of the defender.
function determineDamage(int $attackerDamage, int $defenderArmour): int
{
    $critChance = rand(1, 10);
    if ($critChance === 10) {
        $damage = (int) floor(($attackerDamage * 1.5)) - $defenderArmour;
    } else {
        $damage = $attackerDamage - $defenderArmour;
    }

    if ($damage < 0) {
        $damage = 0;
    }
    return $damage;
}

//Takes three argument, determines if an attack hits or not. WIP!!!!
function chanceToHit(int $attackerWeaponSkill, int $attackerWeaponReq, int $defenderEvasionSkill): bool
{
    if ($attackerWeaponReq > $attackerWeaponSkill) {
        $baseHitChance = (int) floor(($attackerWeaponSkill * 0.5) - $defenderEvasionSkill);
    } else {
        $baseHitChance = $attackerWeaponSkill - $defenderEvasionSkill;
    }

    $baseHitChance = min(max($baseHitChance, 0), 100);

    if ($baseHitChance < rand(0, 100)) {
        return false;
    } else {
        (int) $baseEvadeChance = max($defenderEvasionSkill - $attackerWeaponSkill / 2, 0);
    } //NOT COMPLETE
}

function doBattle(Hero $player, Monster $monster, int $retreatValue): array
{
    $combatLog = [];
    $turn = 1;
    $retreatValue = $retreatValue / 100 * $player->getHP();

    while ($player->getCurrentHP() > $retreatValue) {
        array_push($combatLog, "Turn: " . $turn . ".");
        //if returns true, player goes first else monster goes first.
        if (determineInitiative($player->getInitiative(), $monster->getInitiative())) {
            array_push($combatLog, "Monster gets hit for " . $monster->sufferDamage($player->doDamage()) . ".");
            array_push($combatLog, "Player gets hit for " . $player->sufferDamage($monster->doDamage()) . ".");
        } else {
            array_push($combatLog, "Player gets hit for " . $player->sufferDamage($monster->doDamage()) . ".");
            array_push($combatLog, "Monster gets hit for " . $monster->sufferDamage($player->doDamage()) . ".");
        }
        $turn++;
    }
    return $combatLog;
}
