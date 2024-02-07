<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/armory.php";
session_start();

use App\Hero;
use App\Skill;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if (isset($_POST['equip'])) {
    $itemToEquip = $_POST['equip'];

    foreach ($weapons as $weaponType => $weaponGroup) {
        foreach ($weaponGroup as $weapon) {
            if ($weapon->name === $itemToEquip) {
                $player->weapon = $weapon;

                $_SESSION['player'] = $player->saveHeroState();
            }
        }
    }
}

require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>The Shop</h2>
    <div class="heroShopInfo">
        <h4><?= $player->name; ?></h4>
        <div class="heroGeneralStats">
            <p><span class="bold">HP: </span><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
            <p><span class="bold">Grit: </span><?= $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
            <p><span class="bold">XP: </span><?= $player->getXP() . "/" . $player->getXPtoNext(); ?></p>
            <p><span class="bold">Gold: </span><?= $player->getGold(); ?></p>
        </div>
        <div class="heroGear">
            <h4>Equipped Items</h4>
            <h5 class="bold">Weapon: <?= $player->weapon->name; ?></h5>
            <h4>Inventory</h4>
            <?php if (count($player->getInventory()) > 0) : ?>
                <form method="post" action="">
                    <?php foreach ($player->getInventory() as $item) : ?>
                        <div class="inventoryItem">
                            <h5 class="bold"><?= $item->name; ?></h5>
                            <button type="submit" name="equip" value="<?= $item->name; ?>">Equip</button>
                        </div>
                    <?php endforeach; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_SESSION['error'])) : ?>
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
        <div class="weaponContainer">
            <h3>Weapons</h3>
            <?php $itemID = 0;
            foreach ($weapons as $weaponType => $weaponGroup) : ?>
                <div class="weaponCategory">
                    <h4><?= $weaponType; ?></h4>
                    <?php $weaponIndex = 0;
                    //Here we include all relevant Weapon-properties to be show in the Shop-modulo
                    foreach ($weaponGroup as $weapon) : ?>
                        <div class="shopItem pointer shopWeapon" onclick="showWeaponDetails(<?= $itemID; ?>, 
                    '<?= $weapon->name; ?>', 
                    '<?= $weapon->cost; ?>',
                    '<?= $weapon->skillRequirement; ?>',
                    '<?= $weapon->minDamage; ?>',
                    '<?= $weapon->maxDamage; ?>',
                    '<?= $weapon->getItemDescription(); ?>',
                    '<?= $weaponType; ?>',
                    '<?= $weaponIndex; ?>')">
                            <h5 class="underlineHover">[<?= $weapon->name; ?>]</h5>
                        </div>
                    <?php
                        $itemID++;
                        $weaponIndex++;
                    endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="shieldContainer">
            <h3>Shields</h3>
            <?php foreach ($shields as $shield) : ?>
                <div class="shopItem pointer">
                    <h5 class="underlineHover">[<?= $shield->name; ?>]</h5>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Trying out the modulo game, item information goes here -->
    <div class="overlay" id="overlay">
        <div class="overlayContent" id="overlayContent">
            <div class="details" id="details">
                <!-- JS puts item deets here. See div "shopItem" for information about what gets sent here.
        Form field and Buy-button is also added through JS, along with two hidden input elements containing
    weaponType (eg "Swords") and weaponIndex-->
            </div>
        </div>
    </div>

</main>
<script src="/styles/shopModulo.js"></script>
<?php require __DIR__ . "/../nav/footer.html";
