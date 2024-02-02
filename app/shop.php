<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/weaponLibrary.php";
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
    <h3>Welcome to the Shop, <?= $player->name; ?></h3>
    <h4>Current Equipment</h4>
    <p>Weapon: <?= $player->weapon->name; ?></p>
    <?php if (count($player->getInventory()) > 0) : ?>
        <h4>Inventory</h4>
        <form method="post" action="">
            <?php foreach ($player->getInventory() as $item) : ?>
                <div class="inventoryItem">
                    <p><?= $item->name; ?></p>
                    <button type="submit" name="equip" value="<?= $item->name; ?>">Equip</button>
                </div>
            <?php endforeach; ?>
        </form>
    <?php endif; ?>
    <p>Gold: <?= $player->getGold(); ?></p>

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
        <h3>Mr Weapon Vendor</h3>
        <?php $itemID = 0;
        foreach ($weapons as $weaponType => $weaponGroup) : ?>
            <div class="shopCategory">
                <h4><?= $weaponType; ?></h4>
                <?php $weaponIndex = 0;
                //Here we include all relevant Weapon-properties to be show in the Shop-modulo
                foreach ($weaponGroup as $weapon) : ?>
                    <div class="shopItem pointer" onclick="showDetails(<?= $itemID++; ?>, 
                    '<?= $weapon->name; ?>', 
                    '<?= $weapon->cost; ?>',
                    '<?= $weapon->skillRequirement; ?>',
                    '<?= $weapon->minDamage; ?>',
                    '<?= $weapon->maxDamage; ?>',
                    '<?= $weapon->getItemDescription(); ?>',
                    '<?= $weaponType; ?>',
                    '<?= $weaponIndex; ?>')">
                        <h5 class="underlineHover">[<?= $weapon->name ?>]</h5>
                        <h5>Cost: <?= $weapon->cost; ?>g</h5>
                    </div>
                <?php
                    $weaponIndex++;
                endforeach; ?>
            </div>
        <?php endforeach; ?>
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
