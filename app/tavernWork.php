<?php
require_once __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";

if (!isset($_SESSION['playerID'])) {
    header('Location:' . $baseURL . '/index.php');
    exit();
}

if (!isset($_SESSION['player']['weapon'])) {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}

$player = loadHero($database);

if (isset($_POST['barWork']) && $player->getCurrentGrit() >= 35) {
    $player->setGold($player->getGold() + 15);
    $player->setCurrentGrit($player->getCurrentGrit() - 35);
    $_SESSION['barComplete'] = "What, you want applause? Take your gold and get out..";
} else {
    $_SESSION['barComplete'] = "Didn't think you were up for it. Weren't wrong.";
}
saveHero($player, $database);

header('Location:' . $baseURL . '/app/tavern.php');
exit();
