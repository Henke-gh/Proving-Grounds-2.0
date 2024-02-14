<?php
require_once __DIR__ . "/../bootstrap.php";
session_start();

use App\Hero;

$_SESSION['player'] = $database->getHero($_SESSION['playerID']);

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

$player->regenerateHPnGrit();
$_SESSION['player'] = $player->saveHeroState();
$saveHero = serialize($_SESSION['player']);

$database->updateHero($_SESSION['playerID'], $saveHero);

if (isset($_POST['barWork']) && $player->getCurrentGrit() > 35) {
    $player->setGold($player->getGold() + 15);
    $player->setCurrentGrit($player->getCurrentGrit() - 35);
    $_SESSION['barComplete'] = "What, you want applause? Take your gold and get out..";
} else {
    $_SESSION['barComplete'] = "Didn't think you were up for it. Weren't wrong.";
}
$_SESSION['player'] = $player->saveHeroState();
$saveHero = serialize($_SESSION['player']);
$database->updateHero($_SESSION['playerID'], $saveHero);

header('Location: /../app/tavern.php');
exit();
