<?php
//relates to playerSummary.php - Require this on all pages that present the playerSummary.
if (isset($_POST['equip'])) {
    $itemID = $_POST['itemIndex'];
    $itemCategory = $_POST['category'];
    switch ($itemCategory) {
        case 'shields':
            if ($player->shield->name !== "None") {
                $player->addInventoryShield($player->shield);
            }
            $player->shield = $player->getInventory()['shields'][$itemID];
            $player->removeInventoryItem($player->shield, 'shields');
            saveHero($player, $database);
            break;
        case 'armours':
            if ($player->armour->name !== "Tunic") {
                $player->addInventoryArmour($player->armour);
            }
            $player->armour = $player->getInventory()['armours'][$itemID];
            $player->removeInventoryItem($player->armour, 'armours');
            saveHero($player, $database);
            break;
        case 'trinkets':
            $trinket = $player->getInventory()['trinkets'][$itemID];
            if (count($player->getTrinkets()) < 5) {
                $player->addTrinket($trinket);
                $trinket->applyBonuses($player);
                $player->removeInventoryItem($trinket, 'trinkets');
            } else {
                echo "Too many trinkets..";
            }
            saveHero($player, $database);
            break;

        default:
            if ($player->weapon->name !== "Fists") {
                $player->addInventoryWeapon($player->weapon);
            }
            $player->weapon = $player->getInventory()['weapons'][$itemID];
            $player->removeInventoryItem($player->weapon, 'weapons');
            saveHero($player, $database);
            break;
    }
}

if (isset($_POST['unequip'])) {
    $unequip = $_POST['unequip'];
    switch ($unequip) {
        case 'weapon':
            $player->addInventoryWeapon($player->weapon);
            $player->weapon = $defaultItems['weapon'];
            saveHero($player, $database);
            break;
        case 'shield':
            $player->addInventoryShield($player->shield);
            $player->shield = $defaultItems['shield'];
            saveHero($player, $database);
            break;
        case 'armour':
            $player->addInventoryArmour($player->armour);
            $player->armour = $defaultItems['armour'];
            saveHero($player, $database);
            break;
    }
}
if (isset($_POST['unequipTrinket'])) {
    $trinketName = $_POST['unequipTrinket'];
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
