<?php
require_once __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";

$player = loadHero($database);
saveHero($player, $database);

if (isset($_POST['barWork']) && $player->getCurrentGrit() > 35) {
    $player->setGold($player->getGold() + 15);
    $player->setCurrentGrit($player->getCurrentGrit() - 35);
    $_SESSION['barComplete'] = "What, you want applause? Take your gold and get out..";
} else {
    $_SESSION['barComplete'] = "Didn't think you were up for it. Weren't wrong.";
}
saveHero($player, $database);

header('Location: /../app/tavern.php');
exit();
