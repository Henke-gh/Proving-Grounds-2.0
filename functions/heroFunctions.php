<?php

declare(strict_types=1);

use App\Database\QueryBuilder;
use App\Hero;

function loadHero(QueryBuilder $database): Hero
{
    $_SESSION['player'] = $database->getHero($_SESSION['playerID']);
    $playerSaveState = $_SESSION['player'];
    $player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
    $player->loadHeroState($playerSaveState);
    $player->regenerateHPnGrit();
    return $player;
}

function saveHero(Hero $player, QueryBuilder $database): void
{
    $_SESSION['player'] = $player->saveHeroState();
    $saveHero = serialize($_SESSION['player']);
    $database->updateHero($_SESSION['playerID'], $saveHero);
}
