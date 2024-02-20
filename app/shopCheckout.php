<?php

declare(strict_types=1);
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/armory.php";

$player = loadHero($database);
saveHero($player, $database);

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
        saveHero($player, $database);
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
        saveHero($player, $database);
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
        saveHero($player, $database);
        $_SESSION['itemBought'] = "You bought " . $armourToBuy->name . ".";
        header('Location: /../app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough funds.";
        header('Location: /../app/shop.php');
        exit();
    }
}
if (isset($_POST['purchaseTrinket'])) {
    $itemType = $_POST['item'][0];
    $trinketIndex = $_POST['item'][1];

    $trinketToBuy = $trinkets[$trinketIndex];
    if (in_array($trinketToBuy, $player->getInventory()['trinkets']) || in_array($trinketToBuy, $player->getTrinkets())) {
        $_SESSION['error'] = "You can only have one of those.";
        header('Location: /../app/shop.php');
        exit();
    }
    if ($player->getGold() >= $trinketToBuy->cost) {
        $playerGold = $player->getGold() - $trinketToBuy->cost;
        $player->setGold($playerGold);
        $player->addInventoryTrinket($trinketToBuy);
        saveHero($player, $database);
        $_SESSION['itemBought'] = "You bought " . $trinketToBuy->name . ".";
        header('Location: /../app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough funds.";
        header('Location: /../app/shop.php');
        exit();
    }
}
