<?php

declare(strict_types=1);
session_start();
require __DIR__ . "/../bootstrap.php";

use App\Hero;

if (isset($_POST['logout'])) {
    if (!empty($_SESSION['player'])) {
        $_SESSION['player'] = $database->getHero($_SESSION['playerID']);
        $playerSaveState = $_SESSION['player'];
        $player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
        $player->loadHeroState($playerSaveState);

        $player->regenerateHPnGrit();
        $_SESSION['player'] = $player->saveHeroState();
        $saveHero = serialize($_SESSION['player']);

        $database->updateHero($_SESSION['playerID'], $saveHero);

        unset($_SESSION['player']);
    }
    unset($_SESSION['playerID']);

    header('Location: /../index.php');
}
