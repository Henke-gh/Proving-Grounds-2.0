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
            <h4>Inventory</h4>
            <?php if (count($player->getInventory()) > 0) : ?>
                <form method="post" action="">
                    <?php
                    foreach ($player->getInventory() as $category => $items) :
                        $itemIndex = 0; ?>
                        <?php foreach ($items as $item) : ?>
                            <div class="inventoryItem">
                                <h5 class="bold"><?= $item->name; ?></h5>
                                <input type="hidden" name="category" value="<?= $category ?>">
                                <button type="submit" name="equip" value="<?= $itemIndex; ?>">Equip</button>
                            </div>
                    <?php
                        endforeach;
                    endforeach; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>