<div class="summaryContainer">
    <div class="heroGeneralContainer">
        <img src="<?= $player->getAvatar(); ?>" class="circularImg playerAvatar" title="avatar">
        <div class="heroGeneralStats">
            <p class="bold"><?= $player->name . " - Level: " . $player->getLevel(); ?></p>
            <p class="cursive">Player Title</p>
            <p><span class="bold">HP: </span><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
            <p><span class="bold">Grit: </span><?= $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
            <p><span class="bold">XP: </span><?= $player->getXP() . "/" . $player->getXPtoNext(); ?></p>
            <p><span class="bold">Gold: </span><?= $player->getGold(); ?></p>
        </div>
        <div class="heroGear">
            <h4>Equipped Items</h4>
            <h5 class="bold">Weapon: <?= $player->weapon->name; ?></h5>
            <h5 class="bold">Shield: <?= $player->shield->name; ?></h5>
            <h5 class="bold">Armour: <?= $player->armour->name; ?></h5>
            <h5 class="bold">Total Weight: <?= $player->getTotalWeight(); ?></h5>
            <h4>Inventory</h4>
            <?php if (count($player->getInventory()) > 0) : ?>
                <?php foreach ($player->getInventory() as $category => $items) :
                    foreach ($items as $itemIndex => $item) : ?>
                        <div class="inventoryItem">
                            <h5 class="bold"><?= $item->name; ?></h5>
                            <form method="post" action="">
                                <input type="hidden" name="category" value="<?= $category; ?>">
                                <input type="hidden" name="itemIndex" value="<?= $itemIndex; ?>">
                                <button type="submit" name="equip">Equip</button>
                            </form>
                        </div>
                <?php endforeach;
                endforeach; ?>
            <?php endif; ?>
        </div>
    </div>