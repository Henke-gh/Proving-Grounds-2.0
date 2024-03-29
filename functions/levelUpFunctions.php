<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/levelArrays.php";

use App\Hero;


function levelUp(Hero $player): void
{
    if ($player->getXP() >= $player->getXPtoNext()) {
        $_SESSION['levelUp'] = true;
    } else {
        unset($_SESSION['levelUp']);
    }
}

//sets new player level and sets xp req to next level up to new level from level array.
function getNextLevelXp(Hero $player, array $levels): void
{
    $player->setLevel($player->getLevel() + 1);

    //index starts at 1 as player level can never be 0
    $levelIndex = 1;
    foreach ($levels as $xpReq) {
        if ($player->getLevel() === $levelIndex) {
            $player->setXPtoNext($xpReq);
        }
        $levelIndex++;
    }
}

//increases player Fame rating by 5 each level. If player reached breakpoint for next level, adds +1 fame level
//and sets corresponding fame title + fame amount to reach next level.
function increaseFame(Hero $player, array $fameLevels): void
{
    $addedFame = $player->getFameScore() + 5;
    $player->setFameScore($addedFame);

    if ($player->getFameScore() >= $player->getFameToNext()) {
        $player->setFameLevel($player->getFameLevel() + 1);
        $player->setFameToNext($fameLevels[$player->getFameLevel() + 1]['fame']);
        $player->setFameTitle($fameLevels[$player->getFameLevel()]['title']);
    }
}
