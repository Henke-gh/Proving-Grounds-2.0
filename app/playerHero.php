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
    <?php
    require __DIR__ . "/../nav/ingameNavbar.php";
    require __DIR__ . "/../app/playerSummary.php";
    ?>

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
        <img src="/assets/images/crossing_swords.png" title="swords">
    </div>
    </div>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
