<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/armory.php";
session_start();

use App\Hero;
use App\Skill;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

//relates to playerSummary.php - should probably be required via a separate file.
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
    <?php
    require __DIR__ . "/../nav/ingameNavbar.php";
    require __DIR__ . "/../app/playerSummary.php";

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
        <div class="categorySelector">
            <button class="shopSelector weapons" id="weaponBtn">Weapons</button>
            <button class="shopSelector armour" id="armourBtn">Armour</button>
            <button class="shopSelector shields" id="shieldBtn">Shields</button>
            <button class="shopSelector trinkets" id="trinketBtn">Trinkets</button>
        </div>
        <div class="shopDefault" id="shopDefault">
            <p>Welcome to the Shop, please choose a category to browse.</p>
        </div>
        <div class="weaponContainer hidden shopDisplay" id="weaponContainer">
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
        <div class="armourContainer hidden shopDisplay" id="armourContainer">
            <h3>Armour</h3>
            <?php foreach ($armours as $armour) : ?>
                <div class="shopItem pointer">
                    <h5 class="underlineHover">[<?= $armour->name; ?>]</h5>
                </div>
            <?php endforeach ?>
        </div>
        <div class="shieldContainer hidden shopDisplay" id="shieldContainer">
            <h3>Shields</h3>
            <?php foreach ($shields as $shield) : ?>
                <div class="shopItem pointer">
                    <h5 class="underlineHover">[<?= $shield->name; ?>]</h5>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="trinketContainer hidden shopDisplay" id="trinketContainer">
            <h3>Trinkets</h3>
            <?php foreach ($trinkets as $trinket) : ?>
                <div class="shopItem pointer">
                    <h5 class="underlineHover">[<?= $trinket->name; ?>]</h5>
                </div>
            <?php endforeach ?>
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
<script src="/styles/shopDisplay.js"></script>
<script src="/styles/shopModulo.js"></script>
<?php require __DIR__ . "/../nav/footer.html";
