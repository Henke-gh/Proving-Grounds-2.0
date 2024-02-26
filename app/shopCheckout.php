<?php

declare(strict_types=1);
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/armory.php";

if (!isset($_SESSION['playerID'])) {
    header('Location:' . $baseURL . '/index.php');
    exit();
}

if (!isset($_SESSION['player']['weapon'])) {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}

$player = loadHero($database);

if (isset($_POST['purchaseWeapon'])) {
    $weaponType = htmlspecialchars($_POST['item'][0], ENT_QUOTES);
    $weaponIndex = htmlspecialchars($_POST['item'][1], ENT_QUOTES);
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
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough gold.";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    }
}

if (isset($_POST['purchaseShield'])) {
    $itemType = htmlspecialchars($_POST['item'][0], ENT_QUOTES);
    $shieldIndex = htmlspecialchars($_POST['item'][1], ENT_QUOTES);

    $shieldToBuy = $shields[$shieldIndex];
    if ($player->getGold() >= $shieldToBuy->cost) {
        $playerGold = $player->getGold() - $shieldToBuy->cost;
        $player->setGold($playerGold);
        $player->addInventoryShield($shieldToBuy);
        saveHero($player, $database);
        $_SESSION['itemBought'] = "You bought a " . $shieldToBuy->name . ".";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough gold.";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    }
}
if (isset($_POST['purchaseArmour'])) {
    $itemType = htmlspecialchars($_POST['item'][0], ENT_QUOTES);
    $armourIndex = htmlspecialchars($_POST['item'][1], ENT_QUOTES);

    $armourToBuy = $armours[$armourIndex];
    if ($player->getGold() >= $armourToBuy->cost) {
        $playerGold = $player->getGold() - $armourToBuy->cost;
        $player->setGold($playerGold);
        $player->addInventoryArmour($armourToBuy);
        saveHero($player, $database);
        $_SESSION['itemBought'] = "You bought " . $armourToBuy->name . ".";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough gold.";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    }
}
if (isset($_POST['purchaseTrinket'])) {
    $itemType = htmlspecialchars($_POST['item'][0], ENT_QUOTES);
    $trinketIndex = htmlspecialchars($_POST['item'][1], ENT_QUOTES);

    $trinketToBuy = $trinkets[$trinketIndex];
    if (in_array($trinketToBuy, $player->getInventory()['trinkets']) || in_array($trinketToBuy, $player->getTrinkets())) {
        $_SESSION['error'] = "You can only have one of those.";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    }
    if ($player->getGold() >= $trinketToBuy->cost) {
        $playerGold = $player->getGold() - $trinketToBuy->cost;
        $player->setGold($playerGold);
        $player->addInventoryTrinket($trinketToBuy);
        saveHero($player, $database);
        $_SESSION['itemBought'] = "You bought " . $trinketToBuy->name . ".";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough gold.";
        header('Location:' . $baseURL . '/app/shop.php');
        exit();
    }
}

if (isset($_POST['sellItem'])) {
    $itemSellValue = htmlspecialchars($_POST['itemSell'][0], ENT_QUOTES);
    $itemID = htmlspecialchars($_POST['itemSell'][1], ENT_QUOTES);
    $itemType = htmlspecialchars($_POST['itemSell'][2], ENT_QUOTES);
    $inventory = $player->getInventory();
    $itemToSell = $inventory[$itemType][$itemID];
    $playerGold = $player->getGold() + $itemSellValue;
    $player->setGold($playerGold);
    $player->removeInventoryItem($itemToSell, $itemType);
    saveHero($player, $database);
    $_SESSION['itemBought'] = "You sold " . $itemToSell->name . ".";
    header('Location:' . $baseURL . '/app/shop.php');
    exit();
}

header('Location:' . $baseURL . '/app/shop.php');
