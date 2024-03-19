<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/combatLogic.php";

use App\Hero;

//The attack functions return an array that gets pushed to the main combat log.
function PvPAttack(Hero $attacker, Hero $defender, array $attackerCombatStats, array $defenderCombatStats): array
{
    $log = [];

    //If critChance = true, deals Crit dmg and bypasses all other checks.
    if (critChance($attackerCombatStats['toHitChance']) === true) {
        $damage = critDamage($attackerCombatStats['damage']);
        array_push($log, $attacker->name . " catches " . $defender->name . " off guard..");
        array_push($log, $attacker->name . " strikes a <span class=bold>furious</span> blow to " . $defender->name . " for " . $defender->sufferDamage($damage) . " damage!");
    } else {
        $damage = determineDamage($attackerCombatStats['damage'], $defender->armour->getDmgReduction());
        if (chanceToHit($attackerCombatStats['toHitChance'], $attacker->weapon->skillRequirement, $defenderCombatStats['toHitChance']) === false) {
            array_push($log, $attacker->name . " misses..");
        } elseif (tryEvasion($attackerCombatStats['toHitChance'], $attacker->weapon->skillRequirement, $defenderCombatStats['evasion']) === true) {
            array_push($log, $attacker->name . " moves to strike with " . $attacker->weapon->name . ".. ");
            array_push($log, $defender->name . " dodges the blow!");
        } else {
            if ($defender->canBlock() && tryBlock($attackerCombatStats['toHitChance'], $attacker->weapon->skillRequirement, $defenderCombatStats['block'], $defender->shield->skillRequirement)) {
                array_push($log, $attacker->name . " swings " . $attacker->weapon->name . ".. ");
                array_push($log, $defender->name . " deftly blocks with " . $defender->shield->name . ".");
                $damage = determineDamage($damage, $defender->shield->getDmgReduction());
                array_push($log, $defender->name . " gets hit for " . $defender->sufferDamage($damage) . " damage.");
            } else {
                array_push($log, $attacker->name . " lands a clean blow with " . $attacker->weapon->name . ".");
                array_push($log, $defender->name . " gets hit for " . $defender->sufferDamage($damage) . " damage.");
            }
        }
    }

    return $log;
}

//Rewards to be based on player level difference.
function PvPRewards(): array
{
    $reward = [];
    $reward['gold'] = 30;
    $reward['xp'] = 50;
    return $reward;
}

function doDuel(Hero $aggressor, Hero $defender, string $aggStance, int $aggRetreat, string $defStance, int $defRetreat): array
{
    $combatLog = [];

    $turn = 1;
    /* Aggressor Settings */
    //calculate player HP value at which player gives up and combat ends.
    $aggRetreatValue = (int) floor($aggRetreat / 100 * $aggressor->getHP());
    //determine stance, modifiers are applied further down in the acual combat-loop
    $aggSetStance = $aggStance;
    $aggStanceName = "Balanced";

    if ($aggSetStance === "light") {
        $aggStanceName = "Fast Attacks";
    }
    if ($aggSetStance === "defensive") {
        $aggStanceName = "Heavy Guard";
    }

    $aggReward = PvPRewards();

    //Maybe do this at the end?
    if ($aggressor->getLevel() >= $defender->getLevel() + 2) {
        //Work out duel rewards!
        //$xpReward = (int) floor($xpReward * 0.5);
        //$goldDrop = (int) floor($goldDrop * 0.5);
    }

    /* Defender Settings */
    //calculate player HP value at which player gives up and combat ends.
    $defRetreatValue = (int) floor($defRetreat / 100 * $defender->getHP());
    //determine stance, modifiers are applied further down in the acual combat-loop
    $defSetStance = $defStance;
    $defStanceName = "Balanced";

    if ($defSetStance === "light") {
        $defStanceName = "Fast Attacks";
    }
    if ($aggSetStance === "defensive") {
        $defStanceName = "Heavy Guard";
    }

    $defReward = PvPRewards();

    if ($defender->getLevel() >= $aggressor->getLevel() + 2) {
        //Work out duel rewards!
        //$xpReward = (int) floor($xpReward * 0.5);
        //$goldDrop = (int) floor($goldDrop * 0.5);
    }

    /* Pre-Duel Check */
    if ($defender->getCurrentHP() < $defRetreatValue) {
        array_push($combatLog, "Your wounds are too severe to fight.");
        return $_SESSION['duelFailed'];
    }

    if ($aggressor->getCurrentHP() < $aggRetreatValue) {
        array_push($combatLog, "Opponent's wounds are too severe to fight.");
        return $_SESSION['duelFailed'];
    }

    array_push($combatLog, "<p class=logLine><span class=bold>" . $defender->name . " vs " . $aggressor->name . "</span></p>");

    /* Initiate Duel */
    while ($aggressor->getCurrentHP() > $aggRetreatValue && $defender->getCurrentHP() > $defRetreatValue) {

        //Handle both players stance modifiers here
        $aggCombatStats = initializeCombatAttributes($aggressor, $aggStance);
        $defCombatStats = initializeCombatAttributes($defender, $defStance);

        array_push($combatLog, "<span class=bold>Turn: " . $turn . "</span>");
        //Handle initiative into attack-sequence
        if (determineInitiative($aggCombatStats['initiative'], $defCombatStats['initiative'])) {
            //aggressor goes first
            array_push($combatLog, $aggressor->name . " charges, quick as lightning!");
            $lines = PvPAttack($aggressor, $defender, $aggCombatStats, $defCombatStats);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            //defender (player 2) counter attacks
            if ($defender->getCurrentHP() <= 0) {
                array_push($combatLog, "<span class=bold>" . $defender->name . " is defeated!</span>");
                array_push($combatLog, $aggressor->name . " gains <span class=bold>" . $aggReward['xp'] . " xp</span> and <span class=bold>" . $aggReward['gold'] . " gold.</span>");
                //Add rewards to player character!!!!!!
                //fightReward($aggressor, $goldDrop, $xpReward);
                $aggressor->setCurrentGrit(($aggressor->getCurrentGrit() - $turn));
                break;
            }
        } else {
            //defender goes first
            array_push($combatLog, $defender->name . " gets the upper hand!");
            $lines = PvPAttack($defender, $aggressor, $defCombatStats, $aggCombatStats);
            foreach ($lines as $line) {
                array_push($combatLog, $line);
            }

            //aggressor (player 1) counter attacks
            if ($aggressor->getCurrentHP() <= 0) {
                array_push($combatLog, "<span class=bold>" . $aggressor->name . " is defeated!</span>");
                array_push($combatLog, $defender->name . " gains <span class=bold>" . $defReward['xp'] . " xp</span> and <span class=bold>" . $defReward['gold'] . " gold.</span>");
                //Add rewards to player character!!!!!!
                //fightReward($aggressor, $goldDrop, $xpReward);
                $defender->setCurrentGrit(($defender->getCurrentGrit() - $turn));
                break;
            }
        }
    }

    $turn++;
    return $combatLog;
}
