<?php
//_step3 is cosmetic. A short summary of the player Hero's stats and a welcome screen with hints.
require __DIR__ . "/../vendor/autoload.php";
session_start();

use App\Hero;
use App\Skill;
use App\Weapon;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if (isset($_POST['create'])) {
    $pointsSpent = 0;
    $skillUps = [];
    foreach ($_POST as $stat => $value) {
        if ($stat !== 'create' && $value > 0) {
            $pointsSpent += $value;
            $skillUps[$stat] = $value;
        }
    }
    if ($pointsSpent > 25) {
        $_SESSION['heroCreation'] = 2;
        $_SESSION['error'] = "Not enough skill points!";
        header('Location: /../app/heroCreation_step2.php');
        exit();
    } else if ($pointsSpent < 25) {
        $_SESSION['heroCreation'] = 2;
        $_SESSION['error'] = "Make sure to spend all your skill points!";
        header('Location: /../app/heroCreation_step2.php');
        exit();
    } else {
        foreach ($skillUps as $skill => $value) {
            switch ($skill) {
                case 'strength':
                    $player->setStrength($value);
                    break;
                case 'speed':
                    $player->setSpeed($value);
                    break;
                case 'vitality':
                    $player->setVitality($value);
                    break;

                default:
                    $player->setSkill($skill, $value);
                    break;
            }
        }
        $player->updateDerivedStats();
    }
}

require __DIR__ . "/../nav/header.php";

?>
<main>
    <h2>Final Char Creation Screen</h2>
    <p><?= $player->name; ?></p>
    <p><?= $player->gender; ?></p>
    <p><?= "HP: " . $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
    <p><?= "Grit: " . $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
    <p><?= "Fatigue: " . $player->getFatigue(); ?></p>
    <p><?= "Gold: " . $player->getGold(); ?></p>
    <h3>Base Attributes</h3>
    <div class="statContainer">
        <p>Strength: <?= $player->getStrength(); ?></p>
    </div>
    <div class="statContainer">
        <p>Speed: <?= $player->getSpeed(); ?></p>
    </div>
    <div class="statContainer">
        <p>Vitality: <?= $player->getVitality(); ?></p>
    </div>
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

                default:
                    if ($skill->name !== 'Evasion' && $skill->name !== 'Initiative') : ?>
                        <p><?= ucfirst($skill->name) . ": " . $skill->value; ?></p>
            <?php endif;
                    break;
            endswitch; ?>

    <?php endif;
    endforeach; ?>

    <div>
        <a href="/app/shop.php">
            <p>Good show, now go visit the shop!</p>
        </a>
    </div>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
