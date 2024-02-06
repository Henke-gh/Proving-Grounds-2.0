<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use App\Hero;

$levels = [
    'level 1' => 200,
    'level 2' => 350,
    'level 3' => 450,
    'level 4' => 550,
    'level 5' => 700
];

function levelUp(Hero $player)
{
    if ($player->getXP() >= $player->getXPtoNext()) {
        $_SESSION['levelUp'] = true;
    }
}

//sets new player level and sets xp req to next level up to new level from level array.
function getNextLevelXp(Hero $player, array $levels): void
{
    $player->setLevel($player->getLevel() + 1);

    $levelIndex = 1;
    foreach ($levels as $xpReq) {
        if ($player->getLevel() === $levelIndex) {
            $player->setXPtoNext($xpReq);
        }
        $levelIndex++;
    }
}
