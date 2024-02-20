<?php

declare(strict_types=1);
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";

if (isset($_POST['logout'])) {
    if (!empty($_SESSION['player'])) {
        $player = loadHero($database);
        saveHero($player, $database);

        unset($_SESSION['player']);
    }
    unset($_SESSION['playerID']);

    header('Location: /../index.php');
}
