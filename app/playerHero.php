<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/armory.php";
session_start();

use App\Hero;

if (!isset($_SESSION['player'])) {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);
$player->regenerateHPnGrit();
$_SESSION['player'] = $player->saveHeroState();

require __DIR__ . "/../app/playerEquips.php";

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
        <div class="imageContainer">
            <img src="/assets/images/crossing_swords.png" title="swords">
        </div>
        <div class="combatStatistics">
            <h4>Combat Stats</h4>
            <div class="combatStatValues">
                <p>Wins: <?= $player->getWins(); ?></p>
                <p>Losses: <?= $player->getLosses(); ?></p>
                <p>Total: <?= $player->getTotalFights(); ?></p>
                <p>Win Ratio: <?= $player->getWinLossRatio(); ?>%</p>
            </div>
        </div>
    </div>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
