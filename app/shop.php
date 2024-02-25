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
        <?php
        if (isset($_SESSION['error'])) : ?>
            <div class="errorMsg">
                <h3><?= $_SESSION['error']; ?></h3>
            </div>
        <?php
            unset($_SESSION['error']);
        endif; ?>

        <?php if (isset($_SESSION['itemBought'])) : ?>
            <div class="successMsg">
                <h3><?= $_SESSION['itemBought']; ?></h3>
            </div>
        <?php
            unset($_SESSION['itemBought']);
        endif; ?>

        <div class="shopContainer">
            <div class="shopTagline">
                <h3>Gourflarbfth's Emporium</h3>
            </div>
            <div class="categorySelector">
                <button class="shopSelector weapons" id="weaponBtn">Weapons</button>
                <button class="shopSelector armour" id="armourBtn">Armour</button>
                <button class="shopSelector shields" id="shieldBtn">Shields</button>
                <button class="shopSelector trinkets" id="trinketBtn">Trinkets</button>
                <button class="shopSelector sell" id="sellBtn">Sell Items</button>
            </div>
            <div class="shopDefault" id="shopDefault">
                <p>Please choose a category to browse.</p>
            </div>
            <div class="weaponContainer hidden shopDisplay" id="weaponContainer">
                <h3>Weapons</h3>
                <?php
                foreach ($weapons as $weaponType => $weaponGroup) : ?>
                    <div class="weaponCategory">
                        <h4>- <?= $weaponType; ?> -</h4>
                        <?php
                        foreach ($weaponGroup as $weaponID => $weapon) : ?>
                            <div class="shopItem shopWeapon">
                                <div class="itemSelect">
                                    <p><span class="bold">[<?= $weapon->name; ?>] - </span>Cost: <?= $weapon->cost; ?> gold</p>
                                    <button class="showItem">Show</button>
                                </div>
                                <div class="itemDetails hidden">
                                    <form method="post" action="<?= $baseURL; ?>/app/shopCheckout.php">
                                        <p><span class="bold">Damage:</span> <?= $weapon->minDamage . "-" . $weapon->maxDamage; ?></p>
                                        <?php if ($weapon->getInitiativeBonus() > 0) : ?>
                                            <p><span class="bold">Initiative:</span> +<?= $weapon->getInitiativeBonus(); ?></p>
                                        <?php endif; ?>
                                        <?php if ($weapon->getEvasionBonus() > 0) : ?>
                                            <p><span class="bold">Evasion:</span> +<?= $weapon->getEvasionBonus(); ?></p>
                                        <?php endif; ?>
                                        <p><span class="bold">Skill req:</span> <?= $weapon->skillRequirement . " " .  $weaponType; ?></p>
                                        <p><span class="bold">Weight:</span> <?= $weapon->weight; ?></p>
                                        <p><?= $weapon->getItemDescription(); ?></p>
                                        <input type="hidden" name="item[]" value="<?= $weaponType; ?>">
                                        <input type="hidden" name="item[]" value="<?= $weaponID; ?>">
                                        <button type="submit" name="purchaseWeapon">Purchase</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="armourContainer hidden shopDisplay" id="armourContainer">
                <h3>Armour</h3>
                <?php
                foreach ($armours as $armourID => $armour) : ?>
                    <div class="shopItem shopArmour">
                        <div class="itemSelect">
                            <p><span class="bold">[<?= $armour->name; ?>] - </span>Cost: <?= $armour->cost; ?> gold</p>
                            <button class="showItem">Show</button>
                        </div>
                        <div class="itemDetails hidden">
                            <form method="post" action="<?= $baseURL; ?>/app/shopCheckout.php">
                                <?php if ($armour->getDmgReduction() > 0) : ?>
                                    <p><span class="bold">Dmg Reduction:</span> <?= $armour->getDmgReduction(); ?></p>
                                <?php endif;
                                if ($armour->getEvasionBonus() > 0) : ?>
                                    <p><span class="bold">Evasion:</span> <?= $armour->getEvasionBonus(); ?></p>
                                <?php endif; ?>
                                <p><span class="bold">Weight:</span> <?= $armour->weight; ?></p>
                                <p><?= $armour->getItemDescription(); ?></p>
                                <input type="hidden" name="item[]" value="<?= $armour->type; ?>">
                                <input type="hidden" name="item[]" value="<?= $armourID; ?>">
                                <button type="submit" name="purchaseArmour">Purchase</button>
                            </form>
                        </div>
                    </div>
                <?php
                endforeach ?>
            </div>
            <div class="shieldContainer hidden shopDisplay" id="shieldContainer">
                <h3>Shields</h3>
                <?php
                foreach ($shields as $shieldID => $shield) : ?>
                    <div class="shopItem shopShield">
                        <div class="itemSelect">
                            <p><span class="bold">[<?= $shield->name; ?>] - </span>Cost: <?= $shield->cost; ?> gold</p>
                            <button class="showItem">Show</button>
                        </div>
                        <div class="itemDetails hidden">
                            <form method="post" action="<?= $baseURL; ?>/app/shopCheckout.php">
                                <p><span class="bold">Dmg Reduction:</span> <?= $shield->getDmgReduction(); ?></p>
                                <?php if ($shield->getBlockBonus() > 0) : ?>
                                    <p><span class="bold">Block:</span> +<?= $shield->getBlockBonus(); ?></p>
                                <?php endif; ?>
                                <p><span class="bold">Skill req:</span> <?= $shield->skillRequirement; ?></p>
                                <p><span class="bold">Weight:</span> <?= $shield->weight; ?></p>
                                <p><?= $shield->getItemDescription(); ?></p>
                                <input type="hidden" name="item[]" value="<?= $shield->type; ?>">
                                <input type="hidden" name="item[]" value="<?= $shieldID; ?>">
                                <button type="submit" name="purchaseShield">Purchase</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="trinketContainer hidden shopDisplay" id="trinketContainer">
                <h3>Trinkets</h3>
                <p>Trinkets are powerful curios. Your hero can only carry one of each.</p>
                <p>Limited to a maximum of three equipped trinkets at a time.</p>
                <?php foreach ($trinkets as $trinketID => $trinket) : ?>
                    <div class="shopItem shopTrinket">
                        <div class="itemSelect">
                            <p><span class="bold">[<?= $trinket->name; ?>] - </span>Cost: <?= $trinket->cost; ?> gold</p>
                            <button class="showItem">Show</button>
                        </div>
                        <div class="itemDetails hidden">
                            <form method="post" action="<?= $baseURL; ?>/app/shopCheckout.php">
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
                                <p><?= $trinket->getItemDescription(); ?></p>
                                <input type="hidden" name="item[]" value="<?= $trinket->type; ?>">
                                <input type="hidden" name="item[]" value="<?= $trinketID; ?>">
                                <button type="submit" name="purchaseTrinket">Purchase</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="sellContainer hidden shopDisplay" id="sellContainer">
                <h3><?= $player->name ?>'s Items</h3>
                <?php if (emptyBags($player)) : ?>
                    <p>You have no items to sell.</p>
                    <?php else :
                    foreach ($player->getInventory() as $category => $items) :
                        foreach ($items as $itemID => $item) :
                            $sellValue = (int) floor($item->cost * 0.4); ?>
                            <div class="shopItem shopTrinket">
                                <div class="itemSelect">
                                    <p><span class="bold">[<?= $item->name; ?>] - </span>Sell Value: <?= $sellValue; ?> gold</p>
                                    <button class="showItem">Show</button>
                                </div>
                                <div class="itemDetails hidden">
                                    <form method="post" action="<?= $baseURL; ?>/app/shopCheckout.php">
                                        <p>Do you want to sell <?= $item->name; ?>?</p>
                                        <input type="hidden" name="itemSell[]" value="<?= $sellValue; ?>">
                                        <input type="hidden" name="itemSell[]" value="<?= $itemID; ?>">
                                        <input type="hidden" name="itemSell[]" value="<?= $category; ?>">
                                        <button type="submit" name="sellItem">Sell Item</button>
                                    </form>
                                </div>
                            </div>
                <?php endforeach;
                    endforeach;
                endif; ?>
            </div>
        </div>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<script src="<?= $baseURL; ?>/styles/shopDisplay.js"></script>
<script src="<?= $baseURL; ?>/styles/shopItems.js"></script>
<?php require __DIR__ . "/../nav/footer.php";
