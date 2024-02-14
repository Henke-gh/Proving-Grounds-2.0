<?php
//relates to playerSummary.php - Require this on all pages that present the playerSummary.
if (isset($_POST['equip'])) {
    $itemID = $_POST['itemIndex'];
    $itemCategory = $_POST['category'];
    switch ($itemCategory) {
        case 'shields':
            $player->addInventoryShield($player->shield);
            $player->shield = $player->getInventory()['shields'][$itemID];
            $player->removeInventoryItem($player->shield, 'shields');
            $_SESSION['player'] = $player->saveHeroState();
            $saveHero = serialize($_SESSION['player']);
            $database->updateHero($_SESSION['playerID'], $saveHero);
            break;
        case 'armours':
            $player->addInventoryArmour($player->armour);
            $player->armour = $player->getInventory()['armours'][$itemID];
            $player->removeInventoryItem($player->armour, 'armours');
            $_SESSION['player'] = $player->saveHeroState();
            $saveHero = serialize($_SESSION['player']);
            $database->updateHero($_SESSION['playerID'], $saveHero);
            break;
        case 'trinkets':
            # code...
            $_SESSION['player'] = $player->saveHeroState();
            $saveHero = serialize($_SESSION['player']);
            $database->updateHero($_SESSION['playerID'], $saveHero);
            break;

        default:
            $player->addInventoryWeapon($player->weapon);
            $player->weapon = $player->getInventory()['weapons'][$itemID];
            $player->removeInventoryItem($player->weapon, 'weapons');
            $_SESSION['player'] = $player->saveHeroState();
            $saveHero = serialize($_SESSION['player']);
            $database->updateHero($_SESSION['playerID'], $saveHero);
            break;
    }
}

if (isset($_POST['unequip'])) {
    $unequip = $_POST['unequip'];
    switch ($unequip) {
        case 'weapon':
            $player->addInventoryWeapon($player->weapon);
            $player->weapon = $defaultItems['weapon'];
            break;
        case 'shield':
            $player->addInventoryShield($player->shield);
            $player->shield = $defaultItems['shield'];
            break;
        case 'armour':
            $player->addInventoryArmour($player->armour);
            $player->armour = $defaultItems['armour'];
            break;
    }
}
