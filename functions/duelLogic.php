<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/combatLogic.php";

use App\Hero;

//function playerSettings()

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
        //Handle initiative into attack-sequence
        array_push($combatLog, "<span class=bold>Turn: " . $turn . "</span>");
    }

    $turn++;
    return $combatLog;
}
