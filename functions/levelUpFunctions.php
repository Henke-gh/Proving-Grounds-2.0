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
