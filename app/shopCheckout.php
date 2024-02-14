<?php

declare(strict_types=1);
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/armory.php";

use App\Hero;

session_start();

$_SESSION['player'] = $database->getHero($_SESSION['playerID']);

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

$player->regenerateHPnGrit();
$_SESSION['player'] = $player->saveHeroState();
$saveHero = serialize($_SESSION['player']);

$database->updateHero($_SESSION['playerID'], $saveHero);

if (isset($_POST['purchaseWeapon'])) {
    $weaponType = $_POST['item'][0];
    $weaponIndex = $_POST['item'][1];
    //Get weapon from the weapons array
    $weapon = $weapons[$weaponType][$weaponIndex];
    if ($player->getGold() >= $weapon->cost) {
        //If player has enough gold to cover the cost. Add weapon from array to Hero instance.
        //weapon gets added to the player inventory array from which the player can choose to equip it
        $playergold = $player->getGold() - $weapon->cost;
        $player->setGold($playergold);
        $player->addInventoryWeapon($weapon);
        $_SESSION['player'] = $player->saveHeroState();
        $saveHero = serialize($_SESSION['player']);
        $database->updateHero($_SESSION['playerID'], $saveHero);
        $_SESSION['itemBought'] = "You bought a " . $weapon->name . ".";
        header('Location: /../app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough funds.";
        header('Location: /../app/shop.php');
        exit();
    }
}

if (isset($_POST['purchaseShield'])) {
    $itemType = $_POST['item'][0];
    $shieldIndex = $_POST['item'][1];

    $shieldToBuy = $shields[$shieldIndex];
    if ($player->getGold() >= $shieldToBuy->cost) {
        $playerGold = $player->getGold() - $shieldToBuy->cost;
        $player->setGold($playerGold);
        $player->addInventoryShield($shieldToBuy);
        $_SESSION['player'] = $player->saveHeroState();
        $saveHero = serialize($_SESSION['player']);
        $database->updateHero($_SESSION['playerID'], $saveHero);
        $_SESSION['itemBought'] = "You bought a " . $shieldToBuy->name . ".";
        header('Location: /../app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough funds.";
        header('Location: /../app/shop.php');
        exit();
    }
}
if (isset($_POST['purchaseArmour'])) {
    $itemType = $_POST['item'][0];
    $armourIndex = $_POST['item'][1];

    $armourToBuy = $armours[$armourIndex];
    if ($player->getGold() >= $armourToBuy->cost) {
        $playerGold = $player->getGold() - $armourToBuy->cost;
        $player->setGold($playerGold);
        $player->addInventoryArmour($armourToBuy);
        $_SESSION['player'] = $player->saveHeroState();
        $saveHero = serialize($_SESSION['player']);
        $database->updateHero($_SESSION['playerID'], $saveHero);
        $_SESSION['itemBought'] = "You bought " . $armourToBuy->name . ".";
        header('Location: /../app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough funds.";
        header('Location: /../app/shop.php');
        exit();
    }
}
