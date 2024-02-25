<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/armory.php";

if (!isset($_SESSION['player'])) {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}

$player = loadHero($database);
saveHero($player, $database);

require __DIR__ . "/../app/playerEquips.php";
require __DIR__ . "/../nav/header.php";
?>
<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <div class="summaryContainer">
            <section class="heroSheetHeader">
                <h2>Hero Sheet</h2>
                <div class="inventoryImgContainer">
                    <img src="<?= $baseURL; ?>/assets/images/items.png" class="inventoryImage" />
                </div>
            </section>
            <div class="heroGear">
                <div class="equippedItems">
                    <h3>Equipped Items</h3>
                    <form method="post" action="">
                        <div class="equippedItem">
                            <p><span class="bold">Weapon:</span> <?= $player->weapon->name; ?> (<?= $player->weapon->minDamage . "-" . $player->weapon->maxDamage; ?>)</p>
                            <?php if ($player->weapon->name !== "Fists") : ?>
                                <button type="submit" name="unequip" value="weapon">Unequip</button>
                            <?php endif; ?>
                        </div>
                        <div class="equippedItem">
                            <p><span class="bold">Shield:</span> <?= $player->shield->name; ?></p>
                            <?php if ($player->shield->name !== "None") : ?>
                                <button type="submit" name="unequip" value="shield">Unequip</button>
                            <?php endif; ?>
                        </div>
                        <div class="equippedItem">
                            <p><span class="bold">Armour:</span> <?= $player->armour->name; ?></p>
                            <?php if ($player->armour->name !== "Tunic") : ?>
                                <button type="submit" name="unequip" value="armour">Unequip</button>
                            <?php endif; ?>
                        </div>
                    </form>
                    <?php if (count($player->getTrinkets()) > 0) : ?>
                        <h4>- Trinkets -</h4>
                        <?php foreach ($player->getTrinkets() as $index => $trinket) : ?>
                            <form method="post" action="">
                                <div class="equippedItem">
                                    <p><span class="bold"></span><?= $trinket->name; ?></p>
                                    <button type="submit" name="unequipTrinket" value="<?= $trinket->name; ?>">Unequip</button>
                                </div>
                            </form>
                    <?php endforeach;
                    endif; ?>
                    <p><span class="bold">Total Weight:</span> <?= $player->getTotalWeight(); ?></p>
                </div>
                <div class="heroInventory">
                    <h3>Inventory</h3>
                    <?php if (!emptyBags($player)) : ?>
                        <?php foreach ($player->getInventory() as $category => $items) :
                            foreach ($items as $itemIndex => $item) :
                                if ($item->name !== "Fists" && $item->name !== "None" && $item->name !== "Tunic") : ?>
                                    <div class="inventoryItem">
                                        <p class="bold"><?= $item->name; ?></p>
                                        <form method="post" action="">
                                            <input type="hidden" name="category" value="<?= $category; ?>">
                                            <input type="hidden" name="itemIndex" value="<?= $itemIndex; ?>">
                                            <button type="submit" name="equip">Equip</button>
                                        </form>
                                    </div>
                        <?php endif;
                            endforeach;
                        endforeach; ?>
                    <?php else : ?>
                        <p>- No items in inventory -</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="heroGeneralContainer">
                <div class="heroGeneralStats">
                    <h3><?= $player->name . " - Level: " . $player->getLevel(); ?></h3>
                    <p class="cursive"><?= $player->getFameTitle() . " (" . $player->getFameScore() . ")"; ?></p>
                    <p><span class="bold">HP: </span><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
                    <p><span class="bold">Grit: </span><?= $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
                    <p><span class="bold">XP: </span><?= $player->getXP() . "/" . $player->getXPtoNext(); ?></p>
                    <p><span class="bold">Gold: </span><?= $player->getGold(); ?></p>
                </div>

                <div class="heroBaseAttributes">
                    <h3>Base Attributes</h3>
                    <p>Strength: <?= $player->getStrength(); ?></p>
                    <p>Speed: <?= $player->getSpeed(); ?></p>
                    <p>Vitality: <?= $player->getVitality(); ?></p>
                </div>
                <div class="heroSkills">
                    <h3>Skills</h3>
                    <?php foreach ($player->getSkills() as $skill) :
                        switch ($skill->name):
                            case 'Evasion': ?>
                                <p><?= ucfirst($skill->name) . ": " . $player->getEvasion(); ?></p>
                            <?php
                                break;
                            case 'Initiative': ?>
                                <p><?= ucfirst($skill->name) . ": " . $player->getInitiative(); ?></p>
                            <?php
                                break;
                            case 'Block': ?>
                                <p><?= ucfirst($skill->name) . ": " . $player->getBlock(); ?></p>
                                <?php
                                break;

                            default:
                                if ($skill->value > 0) : ?>
                                    <p><?= ucfirst($skill->name) . ": " . $skill->value; ?></p>
                        <?php endif;
                                break;
                        endswitch; ?>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
        <div class="combatStatistics">
            <h3>Combat Stats</h3>
            <div class="combatStatValues">
                <p><span class="bold">Wins:</span> <?= $player->getWins(); ?></p>
                <p><span class="bold">Losses:</span> <?= $player->getLosses(); ?></p>
                <p><span class="bold">Total:</span> <?= $player->getTotalFights(); ?></p>
                <p><span class="bold">Win Ratio:</span> <?= $player->getWinLossRatio(); ?>%</p>
            </div>
        </div>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<?php
require __DIR__ . "/../nav/footer.php";
