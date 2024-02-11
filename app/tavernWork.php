<?php
require_once __DIR__ . "/../vendor/autoload.php";
session_start();

use App\Hero;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if (isset($_POST['barWork']) && $player->getCurrentGrit() > 35) {
    $player->setGold($player->getGold() + 15);
    $player->setCurrentGrit($player->getCurrentGrit() - 35);
    $_SESSION['barComplete'] = "What, you want applause? Take your gold and get out..";
} else {
    $_SESSION['barComplete'] = "Didn't think you were up for it. Weren't wrong.";
}
$_SESSION['player'] = $player->saveHeroState();

header('Location: /../app/tavern.php');
exit();
