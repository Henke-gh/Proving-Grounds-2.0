<?php require __DIR__ . "/../app/levelUpMessage.php"; ?>
<div class="summaryContainer">
    <div class="heroGeneralContainer">
        <div class="heroCard">
            <img src="<?= $player->getAvatar(); ?>" class="circularImg playerAvatar" title="avatar">
            <div class="heroGeneralStats">
                <p class="bold"><?= $player->name . " - Level: " . $player->getLevel(); ?></p>
                <p class="cursive"><?= $player->getFameTitle() . " (" . $player->getFameScore() . ")"; ?></p>
                <p><span class="bold">HP: </span><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
                <p><span class="bold">Grit: </span><?= $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
                <p><span class="bold">XP: </span><?= $player->getXP() . "/" . $player->getXPtoNext(); ?></p>
                <p><span class="bold">Gold: </span><?= $player->getGold(); ?></p>
            </div>
        </div>
        <div class="heroGear">
            <div class="equippedItems">
                <h4>Equipped Items</h4>
                <form method="post" action="">
                    <div class="equippedItem">
                        <h5 class="bold">Weapon: <?= $player->weapon->name; ?></h5>
                        <?php if ($player->weapon->name !== "Fists") : ?>
                            <button type="submit" name="unequip" value="weapon">Unequip</button>
                        <?php endif; ?>
                    </div>
                    <div class="equippedItem">
                        <h5 class="bold">Shield: <?= $player->shield->name; ?></h5>
                        <?php if ($player->shield->name !== "None") : ?>
                            <button type="submit" name="unequip" value="shield">Unequip</button>
                        <?php endif; ?>
                    </div>
                    <div class="equippedItem">
                        <h5 class="bold">Armour: <?= $player->armour->name; ?></h5>
                        <?php if ($player->armour->name !== "Tunic") : ?>
                            <button type="submit" name="unequip" value="armour">Unequip</button>
                        <?php endif; ?>
                    </div>
                </form>
                <?php if (count($player->getTrinkets()) > 0) : ?>
                    <h5 class="bold">- Trinkets -</h5>
                    <?php foreach ($player->getTrinkets() as $index => $trinket) : ?>
                        <form method="post" action="">
                            <div class="equippedItem">
                                <h5 class="bold"><?= $trinket->name; ?></h5>
                                <button type="submit" name="unequipTrinket" value="<?= $trinket->name; ?>">Unequip</button>
                            </div>
                        </form>
                <?php endforeach;
                endif; ?>
                <h5 class="bold">Total Weight: <?= $player->getTotalWeight(); ?></h5>
            </div>
            <div class="heroInventory">
                <h4>Inventory</h4>
                <?php if (count($player->getInventory()) > 0) : ?>
                    <?php foreach ($player->getInventory() as $category => $items) :
                        foreach ($items as $itemIndex => $item) :
                            if ($item->name !== "Fists" && $item->name !== "None" && $item->name !== "Tunic") : ?>
                                <div class="inventoryItem">
                                    <h5 class="bold"><?= $item->name; ?></h5>
                                    <form method="post" action="">
                                        <input type="hidden" name="category" value="<?= $category; ?>">
                                        <input type="hidden" name="itemIndex" value="<?= $itemIndex; ?>">
                                        <button type="submit" name="equip">Equip</button>
                                    </form>
                                </div>
                    <?php endif;
                        endforeach;
                    endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>