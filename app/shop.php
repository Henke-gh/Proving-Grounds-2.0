<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/weaponLibrary.php";
session_start();

use App\Hero;
use App\Skill;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>The Shop</h2>
    <h3>Welcome to the Shop, <?= $player->name; ?></h3>
    <p>Current Equipment</p>
    <p>Weapon: <?= $player->weapon->name; ?></p>
    <p>Gold: <?= $player->getGold(); ?></p>

    <div class="shopContainer">
        <h3>Mr Weapon Vendor</h3>
        <form method="post" action="">
            <?php $itemIndex = 0;
            foreach ($weapons as $weaponType => $weaponGroup) : ?>
                <div class="shopCategory">
                    <h4><?= $weaponType; ?></h4>
                    <?php $weaponIndex = 0;
                    //The Option value needs to contain both the weapon type (ie. "Swords") and the items Index relative to the ype
                    //This is why the option value is a serialized array. Weird fix, but it works.
                    foreach ($weaponGroup as $weapon) : ?>
                        <div class="shopItem" onclick="showDetails(<?= $itemIndex++; ?>, 
                    '<?= $weapon->name; ?>', 
                    '<?= $weapon->cost; ?>',
                    '<?= $weapon->minDamage; ?>',
                    '<?= $weapon->maxDamage; ?>',
                    '<?= $weapon->getItemDescription(); ?>')">
                            <h5>[<?= $weapon->name ?>]</h5>
                            <h5>Cost: <?= $weapon->cost; ?>g</h5>
                            <input type="checkbox" value="<?= htmlentities(serialize(array('type' => $weaponType, 'index' => $weaponIndex))); ?>">
                        </div>
                    <?php
                        $weaponIndex++;
                    endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit">Buy</button>
        </form>
    </div>

    <!-- Trying out the modulo game, item information goes here -->
    <div class="overlay" id="overlay">
        <div class="details" id="details">
            <!-- JS puts item deets here. See div "shopItem" for information about what gets sent here. -->
        </div>
    </div>

</main>
<script src="/styles/shopModulo.js"></script>
<?php require __DIR__ . "/../nav/footer.html";
