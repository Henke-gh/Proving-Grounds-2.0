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

//calculate final damage, if not a Crit.
function determineDamage(int $attackerDamage, int $defenderArmour): int
{
    $damage = $attackerDamage - $defenderArmour;

    if ($damage < 0) {
        $damage = 0;
    }
    return $damage;
}

//Might get out of hand at higher skill levels, needs testing!
function critChance($weaponSkillLevel): bool
{
    $critChance = 3 + $weaponSkillLevel / 10;
    if ($critChance >= rand(0, 100)) {
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
        $baseHitChance = $attackerWeaponSkill - $defenderEvasionSkill / 10;
    }

    if ($baseHitChance < rand(0, 10) + $defenderEvasionSkill / 5) {
        return false;
    } else {
        return true;
    }
}

//returns True if evasion is successful
function tryEvasion(int $attackerWeaponSkill, int $attackerWeaponReq, int $defenderEvasionSkill): bool
{
    $targetEvasion = rand(0, $defenderEvasionSkill) + $defenderEvasionSkill / 10;
    $targetAttack = rand(0, $attackerWeaponSkill) + $attackerWeaponSkill / 10;
    if ($attackerWeaponSkill < $attackerWeaponReq) {
        $targetAttack /= 2;
    }
    if ($targetAttack > $targetEvasion) {
        return false;
    } else {
        return true;
    }
}
//should only run if player/monster canBlock returns TRUE
//returns true if block is successful - NOT IMPLEMENTED
function tryBlock(int $attackerWeaponSkill, int $attackerWeaponReq, int $defenderBlockSkill, int $defenderBlockReq): bool
{
    $targetBlock = rand(0, $defenderBlockSkill) + $defenderBlockSkill / 5;
    $targetAttack = rand(0, $attackerWeaponSkill) + $attackerWeaponSkill / 10;
    if ($attackerWeaponSkill < $attackerWeaponReq) {
        $targetAttack /= 2;
    }
    if ($defenderBlockSkill < $defenderBlockReq) {
        $targetBlock /= 2;
    }

    if ($targetAttack > $targetBlock) {
        return false;
    } else {
        return true;
    }
}

//The attack functions return an array that gets pushed to the main combat log.
function playerAttack(Hero $player, Monster $monster, int $playerToHitChance, int $playerDmg): array
{
    $log = [];
    //If critChance = true, deals Crit dmg and bypasses all other checks.
    if (critChance($playerToHitChance) === true) {
        $damage = critDamage($playerDmg);
        array_push($log, $player->name . " swings " . $player->weapon->name . ".. ");
        array_push($log, $player->name . " strikes a <span class=bold>furious</span> blow to " . $monster->name . " for " . $monster->sufferDamage($damage) . " damage!");
    } else {
        $damage = determineDamage($playerDmg, $monster->getDmgReduction());
        if (chanceToHit($playerToHitChance, $player->weapon->skillRequirement, $monster->toHitChance()) === false) {
            array_push($log, $player->name . " misses..");
        } elseif (tryEvasion($playerToHitChance, $player->weapon->skillRequirement, $monster->getEvasion()) === true) {
            array_push($log, $player->name . " swings " . $player->weapon->name . ".. ");
            array_push($log, $monster->name . " dodges the blow!");
        } else {
            if ($monster->canBlock() && tryBlock($playerToHitChance, $player->weapon->skillRequirement, $monster->getBlock(), $monster->shield->skillRequirement)) {
                array_push($log, $player->name . " swings " . $player->weapon->name . ".. ");
                array_push($log, $monster->name . " deftly blocks with " . $monster->shield->name . ".");
                $damage = determineDamage($damage, $monster->shield->getDmgReduction());
                array_push($log, $monster->name . " gets hit for " . $monster->sufferDamage($damage) . " damage.");
            } else {
                array_push($log, $player->name . " swings " . $player->weapon->name . ".. ");
                array_push($log, $monster->name . " gets hit for " . $monster->sufferDamage($damage) . " damage.");
            }
        }
    }

    return $log;
}

function monsterAttack(Monster $monster, Hero $player, int $playerEvasion, int $playerBlock): array
{
    $playerEvasion -= $player->getWeightModifier();
    if ($playerEvasion < 0) {
        $playerEvasion = 0;
    }
    $playerBlock -= $player->getWeightModifier();
    if ($playerBlock < 0) {
        $playerBlock = 0;
    }
    $log = [];
    if (critChance($monster->toHitChance()) === true) {
        $damage = critDamage($monster->doDamage());
        array_push($log, $monster->name . " winds up a deadly attack with " . $monster->weapon->name . ".. ");
        array_push($log, $monster->name . " strikes a <span class=bold>murderous</span> blow to " . $player->name . " for " . $player->sufferDamage($damage) . " damage!");
    } else {
        $damage = determineDamage($monster->doDamage(), $player->armour->getDmgReduction());
        if (chanceToHit($monster->toHitChance(), $monster->weapon->skillRequirement, $playerEvasion) === false) {
            array_push($log, $monster->name . " attempts to strike with " . $monster->weapon->name . ".. ");
            array_push($log, $monster->name . " misses..");
        } elseif (tryEvasion($monster->toHitChance(), $monster->weapon->skillRequirement, $playerEvasion)) {
            array_push($log, $monster->name . " moves to strike with " . $monster->weapon->name . ".. ");
            array_push($log, $player->name . " dodges away at the last moment!");
        } else {
            if ($player->canBlock() && tryBlock($monster->toHitChance(), $monster->weapon->skillRequirement, $playerBlock, $player->shield->skillRequirement)) {
                array_push($log, $monster->name . " swings " . $monster->weapon->name . ".. ");
                array_push($log, $player->name . " deftly blocks with " . $player->shield->name . ".");
                $damage = determineDamage($damage, $player->shield->getDmgReduction());
                array_push($log, $player->name . " gets hit for " . $player->sufferDamage($damage) . " damage.");
            } else {
                array_push($log, $monster->name . " delivers a confident blow with " . $monster->weapon->name . ".. ");
                array_push($log, $player->name . " gets hit for " . $player->sufferDamage($damage) . " damage.");
            }
        }
    }

    return $log;
}

function fightReward(Hero $player, int $gold, int $xpReward): void
{
    $player->setGold($player->getGold() + $gold);
    $xp = $xpReward;
    $player->setXP($player->getXP() + $xp);
    $player->setWins(1);
}

function doBattle(Hero $player, Monster $monster, int $retreat, string $stance): array
{
    $combatLog = [];
    $turn = 1;
    //calculate player HP value at which player gives up and combat ends.
    $retreatValue = (int) floor($retreat / 100 * $player->getHP());
    //determine stance, modifiers are applied further down in the acual combat-loop
    $heroStance = $stance;
    $stanceName = "Balanced";

    //since monster gold drop is a random value it has to be set prior as the variable is used twice.
    $goldDrop = $monster->dropGold();
    $xpReward = $monster->xpReward;

    if ($player->getCurrentHP() < $retreatValue) {
        array_push($combatLog, "Your wounds are too severe to fight.");
    } else {
        array_push($combatLog, "<p class=logLine><span class=bold>" . $player->name . " vs " . $monster->name . "</span></p>");
        array_push($combatLog, "<p class=logLine><span class=bold>Stance:</span> " . $stanceName . "</p>");
        array_push($combatLog, "<p class=logLine><span class=bold>Retreating at:</span> " . $retreatValue . " hp</p>");
    }

    while ($player->getCurrentHP() > $retreatValue) {

        if ($heroStance === "light") {
            $playerInitiative = (int) floor($player->getInitiative() * 1.2);
            $playerEvasion = (int) floor($player->getEvasion() * 1.2);
            $playerDamage = (int) floor($player->doDamage() * 0.8);
            $playerToHitChance = $player->toHitChance();
            $playerBlock = $player->getBlock();
            $stanceName = "Fast Attacks";
        }
        if ($heroStance === "defensive") {
            $playerInitiative = (int) floor($player->getInitiative() * 0.5);
            $playerEvasion = $player->getEvasion();
            $playerToHitChance = (int) floor($player->toHitChance() * 0.8);
            $playerBlock = (int) floor($player->getBlock() * 1.2);
            $playerDamage = (int) floor($player->doDamage() * 1.2);
            $stanceName = "Heavy Guard";
        }
        if ($heroStance === "balanced") {
            $playerInitiative = $player->getInitiative();
            $playerEvasion = $player->getEvasion();
            $playerBlock = $player->getBlock();
            $playerToHitChance = $player->toHitChance();
            $playerDamage = $player->doDamage();
        }

        $playerInitiative -= $player->getWeightModifier();
        if ($playerInitiative < 0) {
            $playerInitiative = 0;
        }

        array_push($combatLog, "<span class=bold>Turn: " . $turn . "</span>");
        //if returns true, player goes first else monster goes first.
        if (determineInitiative($playerInitiative, $monster->getInitiative())) {
            array_push($combatLog, $player->name . " charges, quick as lightning!");
            $lines = playerAttack($player, $monster, $playerToHitChance, $playerDamage);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($monster->getCurrentHP() <= 0) {
                array_push($combatLog, "<span class=bold>" . $monster->name . " is defeated!</span>");
                array_push($combatLog, $player->name . " gains <span class=bold>" . $xpReward . " xp</span> and <span class=bold>" . $goldDrop . " gold.</span>");
                fightReward($player, $goldDrop, $xpReward);
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }

            $lines = monsterAttack($monster, $player, $playerEvasion, $playerBlock);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($player->getCurrentHP() <= $retreatValue) {
                array_push($combatLog, "<span class=bold>" . $player->name . " is defeated!</span>");
                $player->setLosses(1);
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }
        } else {
            array_push($combatLog, $monster->name . " storms towards " . $player->name . "!");
            $lines = monsterAttack($monster, $player, $playerEvasion, $playerBlock);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($player->getCurrentHP() <= $retreatValue) {
                array_push($combatLog, "<span class=bold>" . $player->name . " is defeated!</span>");
                $player->setLosses(1);
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }

            $lines = playerAttack($player, $monster, $playerToHitChance, $playerDamage);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            if ($monster->getCurrentHP() <= 0) {
                array_push($combatLog, "<span class=bold>" . $monster->name . " is defeated!</span>");
                array_push($combatLog, $player->name . " gains <span class=bold>" . $xpReward . " xp</span> and <span class=bold>" . $goldDrop . " gold.</span>");
                fightReward($player, $goldDrop, $xpReward);
                $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
                break;
            }
        }
        $turn++;

        if ($player->getFatigue() < $turn) {
            array_push($combatLog, $player->name . " collapses due to fatigue.");
            $player->setLosses(1);
            $player->setCurrentGrit(($player->getCurrentGrit() - $turn));
            break;
        }
    }
    if ($player->isDead()) {
        array_push($combatLog, "<span class=bold>" . $player->name . " was slain by " . $monster->name . "!</span>");
        $_SESSION['playerDeath'] = $combatLog;
    }
    $_SESSION['player'] = $player->saveHeroState();
    return $combatLog;
}
