<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/armory.php";
session_start();

use App\Hero;

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
    <h2><?= $player->name . " - Level: " . $player->getLevel(); ?></h2>
    <h4 class="title cursive">Player Title</h4>
    <div class="summaryContainer">
        <div class="heroGeneralContainer">
            <img src="<?= $player->getAvatar(); ?>">
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
        <div class="heroStats">
            <div class="heroBaseAttributes">
                <h3>Base Attributes</h3>
                <p>Strength: <?= $player->getStrength(); ?></p>
                <p>Speed: <?= $player->getSpeed(); ?></p>
                <p>Vitality: <?= $player->getVitality(); ?></p>
            </div>
            <div class="heroSkills">
                <h3>Skills</h3>
                <?php foreach ($player->getSkills() as $skill) :
                    //Entierly fucked up. Because Evasion and Initiative derive 20% of their total values from the Speed attribute, this is what we get.
                    //Since we check if natural skill value > 0 this modified value won't show unless the player has put points into the corresponding skill stat.
                    //This could be solved by adding EVEN MORE loops. Or we just treat it like a hidden stat. The Mystery.. Game Mechanics.
                    if ($skill->value > 0) :
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
                                if ($skill->name !== 'Evasion' && $skill->name !== 'Initiative') : ?>
                                    <p><?= ucfirst($skill->name) . ": " . $skill->value; ?></p>
                        <?php endif;
                                break;
                        endswitch; ?>

                <?php endif;
                endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
