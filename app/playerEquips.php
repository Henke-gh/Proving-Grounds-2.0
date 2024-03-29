<?php
//relates to playerSummary.php - Require this on all pages that present the playerSummary.
if (!isset($_SESSION['playerID'])) {
    header('Location:' . $baseURL . '/index.php');
    exit();
}

if (!isset($_SESSION['player']['weapon'])) {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}

if (isset($_POST['equip'])) {
    $itemID = htmlspecialchars($_POST['itemIndex'], ENT_QUOTES);
    $itemCategory = htmlspecialchars($_POST['category'], ENT_QUOTES);
    switch ($itemCategory) {
        case 'shields':
            if ($player->shield->name !== "None") {
                $player->addInventoryShield($player->shield);
            }
            $player->shield->removeBonuses($player);
            $player->shield = $player->getInventory()['shields'][$itemID];
            $player->shield->applyBonuses($player);
            $player->removeInventoryItem($player->shield, 'shields');
            saveHero($player, $database);
            break;
        case 'armours':
            if ($player->armour->name !== "Tunic") {
                $player->addInventoryArmour($player->armour);
            }
            $player->armour->removeBonuses($player);
            $player->armour = $player->getInventory()['armours'][$itemID];
            $player->armour->applyBonuses($player);
            $player->removeInventoryItem($player->armour, 'armours');
            saveHero($player, $database);
            break;
        case 'trinkets':
            $trinket = $player->getInventory()['trinkets'][$itemID];
            if (count($player->getTrinkets()) < 3) {
                $player->addTrinket($trinket);
                $trinket->applyBonuses($player);
                $player->removeInventoryItem($trinket, 'trinkets');
            } else {
                $_SESSION['error'] = "Too many trinkets..";
            }
            saveHero($player, $database);
            break;

        default:
            if ($player->weapon->name !== "Fists") {
                $player->addInventoryWeapon($player->weapon);
            }
            $player->weapon->removeBonuses($player);
            $player->weapon = $player->getInventory()['weapons'][$itemID];
            $player->weapon->applyBonuses($player);
            $player->removeInventoryItem($player->weapon, 'weapons');
            saveHero($player, $database);
            break;
    }
}

if (isset($_POST['unequip'])) {
    $unequip = htmlspecialchars($_POST['unequip'], ENT_QUOTES);
    switch ($unequip) {
        case 'weapon':
            $player->weapon->removeBonuses($player);
            $player->addInventoryWeapon($player->weapon);
            $player->weapon = $defaultItems['weapon'];
            saveHero($player, $database);
            break;
        case 'shield':
            $player->shield->removeBonuses($player);
            $player->addInventoryShield($player->shield);
            $player->shield = $defaultItems['shield'];
            saveHero($player, $database);
            break;
        case 'armour':
            $player->armour->removeBonuses($player);
            $player->addInventoryArmour($player->armour);
            $player->armour = $defaultItems['armour'];
            saveHero($player, $database);
            break;
    }
}
if (isset($_POST['unequipTrinket'])) {
    $trinketName = htmlspecialchars($_POST['unequipTrinket'], ENT_QUOTES);
    $trinkets = $player->getTrinkets();
    foreach ($trinkets as $trinket) {
        if ($trinket->name === $trinketName) {
            $player->addInventoryTrinket($trinket);
            $trinket->removeBonuses($player);
            $player->removeTrinket($trinket);
            saveHero($player, $database);
            break;
        }
    }
}
