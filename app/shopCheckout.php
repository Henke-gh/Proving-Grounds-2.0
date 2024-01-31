<?php

declare(strict_types=1);
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/weaponLibrary.php";

use App\Hero;

session_start();

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if (isset($_POST['purchase'])) {
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
        $_SESSION['itemBought'] = "You bought a " . $weapon->name . ".";
        header('Location: /../app/shop.php');
        exit();
    } else {
        $_SESSION['error'] = "Not enough funds.";
        header('Location: /../app/shop.php');
        exit();
    }
}
