<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/monsterLibrary.php";
require __DIR__ . "/../functions/combatLogic.php";

//Not implemented - Work in progress!! Do not push to live

use App\Hero;
use App\Monster;

/* function determineTarget(Monster $monsterBoss, Monster $underlingOne, Monster $underlingTwo): Monster
{
    $targetIndex = rand(1, 3);
    $targetSet = false;

    while (!$targetSet) {
        $target = $monsterBoss;

        switch ($targetIndex) {
            case 1:
                if ($monsterBoss->getCurrentHP() > 0) {
                    $target = $monsterBoss;
                    $targetSet = true;
                    break;
                }
            case 2:
                if ($underlingOne->getCurrentHP() > 0) {
                    $target = $underlingOne;
                    $targetSet = true;
                    break;
                }
            case 3:
                if ($underlingTwo->getCurrentHP() > 0) {
                    $target = $underlingTwo;
                    $targetSet = true;
                    break;
                }
        }
        return $target;
    }
} */

function getTarget(): int
{
    $target = rand(1, 3);
    return $target;
}

/* Prize Fight - WIP */
//The prize fights are once per character fights with greater danger and greater rewards. Fight multiple enemies.
function prizeFight(Hero $player, Monster $monsterBoss, Monster $underlingOne, Monster $underlingTwo, int $retreat, string $stance): array
{
    $combatLog = [];
    $turn = 1;
    //calculate player HP value at which player gives up and combat ends.
    $retreatValue = (int) floor($retreat / 100 * $player->getHP());
    //determine stance, modifiers are applied further down in the acual combat-loop
    $heroStance = $stance;
    $stanceName = "Balanced";

    //since monster gold drop is a random value it has to be set prior as the variable is used twice.
    $goldDrop = $monsterBoss->dropGold();
    $xpReward = $monsterBoss->xpReward;

    if ($player->getLevel() >= $monsterBoss->getLevel() + 10) {
        $xpReward = (int) floor($xpReward * 0.5);
        $goldDrop = (int) floor($goldDrop * 0.5);
    }

    if ($player->getCurrentHP() < $retreatValue) {
        array_push($combatLog, "Your wounds are too severe to fight.");
    } else {
        array_push($combatLog, "<p class=logLine><span class=bold>" . $player->name . " vs " . $monsterBoss->name . "</span></p>");
        array_push($combatLog, "<p class=logLine><span class=bold>Stance:</span> " . $stanceName . "</p>");
        array_push($combatLog, "<p class=logLine><span class=bold>Retreating at:</span> " . $retreatValue . " hp</p>");
    }

    while ($player->getCurrentHP() > $retreatValue) {
        //stance modifiers are handled here because some values are random and I want them to randomize each turn.
        if ($heroStance === "light") {
            $playerInitiative = (int) floor($player->getInitiative() * 1.2);
            $playerEvasion = (int) floor($player->getEvasion() * 1.2);
            $playerDamage = (int) floor($player->doDamage() * 0.8);
            $playerToHitChance = (int) floor($player->toHitChance() * 1.2);
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
        if (determineInitiative($playerInitiative, $monsterBoss->getInitiative())) {
            $target = getTarget();
            switch ($target) {
                case 1:
                    if ($monsterBoss->getCurrentHP() > 0) {
                        $lines = playerAttack($player, $monsterBoss, $playerToHitChance, $playerDamage);
                        foreach ($lines as $line) {
                            array_push($combatLog, $line);
                        }
                        $monsterBoss;
                        break;
                    }
                case 2:
                    if ($underlingOne->getCurrentHP() > 0) {
                        $lines = playerAttack($player, $underlingOne, $playerToHitChance, $playerDamage);
                        foreach ($lines as $line) {
                            array_push($combatLog, $line);
                        }
                        $underlingOne;
                        break;
                    }
                case 3:
                    if ($underlingTwo > 0) {
                        $lines = playerAttack($player, $underlingTwo, $playerToHitChance, $playerDamage);
                        foreach ($lines as $line) {
                            array_push($combatLog, $line);
                        }
                        $underlingTwo;
                        break;
                    }
            } //monsters retaliate
        } else {
            //monsterBoss goes first
        }
    }

    return $combatLog;
}
