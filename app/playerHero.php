<?php
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
            <?php if (isset($_POST['delete'])) : ?>
                <div class="errorMsg deleteHero">
                    <h3>Are you sure you want to delete <?= $player->name; ?>?</h3>
                    <div>
                        <form method="post" action="" class="deleteHeroForm">
                            <button type="submit" name="noDelete">No Thanks!</button>
                        </form>
                        <form method="post" action="<?= $baseURL; ?>/functions/delete.php" class="deleteHeroForm">
                            <button type="submit" name="deleteHero">Delete Hero</button>
                        </form>
                    </div>
                </div>
            <?php
                unset($_POST['deleteHero']);
            endif; ?>
            <section class="heroSheetHeader">
                <h2>Hero Sheet</h2>
                <div class="inventoryImgContainer">
                    <img src="<?= $baseURL; ?>/assets/images/items.png" class="inventoryImage" />
                </div>
            </section>
            <?php
            if (isset($_SESSION['error'])) : ?>
                <div class="errorMsg">
                    <h3><?= $_SESSION['error']; ?></h3>
                </div>
            <?php
                unset($_SESSION['error']);
            endif; ?>
            <div class="heroGear">
                <div class="equippedItems">
                    <h3>Equipped Items</h3>
                    <div class="equippedItem">
                        <dialog class="inspect">
                            <div class="inspectContentContainer">
                                <h3><?= $player->weapon->name; ?></h3>
                                <p><span class="bold">Damage:</span> <?= $player->weapon->minDamage; ?> - <?= $player->weapon->maxDamage; ?></p>
                                <p><span class="bold">Type:</span> <?= $player->weapon->type; ?></p>
                                <p><span class="bold">Skill Req:</span> <?= $player->weapon->skillRequirement; ?></p>
                                <p><span class="bold">Description:</span> <?= $player->weapon->getItemDescription(); ?></p>
                                <button autofocus class="closeInspect">X</button>
                            </div>
                        </dialog>
                        <div class="itemBtnPgroup">
                            <button class="showInspect"><img src="<?= $baseURL; ?>/assets/images/icons/inspect.svg"></button>
                            <p><span class="bold">Weapon:</span> <?= $player->weapon->name; ?></p>
                        </div>
                        <form method="post" action="" class="playerItemForm">
                            <?php if ($player->weapon->name !== "Fists") : ?>
                                <button type="submit" name="unequip" value="weapon">Unequip</button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="equippedItem">
                        <dialog class="inspect">
                            <div class="inspectContentContainer">
                                <h3><?= $player->shield->name; ?></h3>
                                <p><span class="bold">Damage Reduction:</span> <?= $player->shield->getDmgReduction(); ?></p>
                                <p><span class="bold">Type:</span> <?= $player->shield->type; ?></p>
                                <p><span class="bold">Skill Req:</span> <?= $player->shield->skillRequirement; ?></p>
                                <p><span class="bold">Description:</span> <?= $player->shield->getItemDescription(); ?></p>
                                <button autofocus class="closeInspect">X</button>
                            </div>
                        </dialog>
                        <div class="itemBtnPgroup">
                            <button class="showInspect"><img src="<?= $baseURL; ?>/assets/images/icons/inspect.svg"></button>
                            <p><span class="bold">Shield:</span> <?= $player->shield->name; ?></p>
                        </div>
                        <form method="post" action="" class="playerItemForm">
                            <?php if ($player->shield->name !== "None") : ?>
                                <button type="submit" name="unequip" value="shield">Unequip</button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="equippedItem">
                        <dialog class="inspect">
                            <div class="inspectContentContainer">
                                <h3><?= $player->armour->name; ?></h3>
                                <p><span class="bold">Damage Reduction:</span> <?= $player->armour->getDmgReduction(); ?></p>
                                <p><span class="bold">Type:</span> <?= $player->armour->type; ?></p>
                                <p><span class="bold">Description:</span> <?= $player->armour->getItemDescription(); ?></p>
                                <button autofocus class="closeInspect">X</button>
                            </div>
                        </dialog>
                        <div class="itemBtnPgroup">
                            <button class="showInspect"><img src="<?= $baseURL; ?>/assets/images/icons/inspect.svg"></button>
                            <p><span class="bold">Armour:</span> <?= $player->armour->name; ?></p>
                        </div>
                        <form method="post" action="" class="playerItemForm">
                            <?php if ($player->armour->name !== "Tunic") : ?>
                                <button type="submit" name="unequip" value="armour">Unequip</button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <?php if (count($player->getTrinkets()) > 0) : ?>
                        <h4>- Trinkets -</h4>
                        <?php foreach ($player->getTrinkets() as $index => $trinket) : ?>
                            <div class="equippedItem">
                                <dialog class="inspect">
                                    <div class="inspectContentContainer">
                                        <h3><?= $trinket->name; ?></h3>
                                        <?php if ($trinket->getInitiativeBonus() > 0) : ?>
                                            <p><span class="bold">Initiative:</span> +<?= $trinket->getInitiativeBonus(); ?></p>
                                        <?php endif; ?>
                                        <?php if ($trinket->getEvasionBonus() > 0) : ?>
                                            <p><span class="bold">Evasion:</span> +<?= $trinket->getEvasionBonus(); ?></p>
                                        <?php endif; ?>
                                        <?php if ($trinket->getBlockBonus() > 0) : ?>
                                            <p><span class="bold">Block:</span> +<?= $trinket->getBlockBonus(); ?></p>
                                        <?php endif; ?>
                                        <?php if ($trinket->getMaxHP() > 0) : ?>
                                            <p><span class="bold">Max HP:</span> +<?= $trinket->getMaxHP(); ?></p>
                                        <?php endif; ?>
                                        <p><span class="bold">Type:</span> <?= $trinket->type; ?></p>
                                        <p><span class="bold">Description:</span> <?= $trinket->getItemDescription(); ?></p>
                                        <button autofocus class="closeInspect">X</button>
                                        <div class="inspectContentContainer">
                                </dialog>
                                <div class="itemBtnPgroup">
                                    <button class="showInspect"><img src="<?= $baseURL; ?>/assets/images/icons/inspect.svg"></button>
                                    <p><span class="bold"></span><?= $trinket->name; ?></p>
                                </div>
                                <form method="post" action="" class="playerItemForm">
                                    <button type="submit" name="unequipTrinket" value="<?= $trinket->name; ?>">Unequip</button>
                                </form>
                            </div>
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
                                        <dialog class="inspect">
                                            <div class="inspectContentContainer">
                                                <h3><?= $item->name; ?></h3>
                                                <p><span class="bold">Type:</span> <?= $item->type; ?></p>
                                                <?php if ($item->type === "Trinket") : ?>
                                                    <?php if ($item->getInitiativeBonus() > 0) : ?>
                                                        <p><span class="bold">Initiative:</span> +<?= $item->getInitiativeBonus(); ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($item->getEvasionBonus() > 0) : ?>
                                                        <p><span class="bold">Evasion:</span> +<?= $item->getEvasionBonus(); ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($item->getBlockBonus() > 0) : ?>
                                                        <p><span class="bold">Block:</span> +<?= $item->getBlockBonus(); ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($item->getMaxHP() > 0) : ?>
                                                        <p><span class="bold">Max HP:</span> +<?= $item->getMaxHP(); ?></p>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <p><span class="bold">Description:</span> <?= $item->getItemDescription(); ?></p>
                                                <button autofocus class="closeInspect">X</button>
                                                <div class="inspectContentContainer">
                                        </dialog>
                                        <div class="itemBtnPgroup">
                                            <button class="showInspect"><img src="<?= $baseURL; ?>/assets/images/icons/inspect.svg"></button>
                                            <p class="bold"><?= $item->name; ?></p>
                                        </div>
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
        <form method="post">
            <button type="submit" name="delete">Delete Hero</button>
        </form>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<?php
require __DIR__ . "/../nav/footer.php";
