<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../functions/levelUpFunctions.php";
require __DIR__ . "/../app/weaponLibrary.php";
session_start();

if (!isset($_SESSION['levelUp']) || !$_SESSION['levelUp'] === true) {
    header('Location /../app/playerHero.php');
    exit();
}

use App\Hero;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

$skillPoints = 20;

require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>Level up!</h2>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="errorMsg">
            <h3><?= $_SESSION['error']; ?></h3>
        </div>
    <?php
        unset($_SESSION['error']);
    endif; ?>
    <div class="heroSummary">
        <h3><?= $player->name . " - Level: " . $player->getLevel() + 1; ?></h3>
        <p><span class="bold">HP: </span><?= $player->getHP() . "/" . $player->getHP(); ?></p>
    </div>
    <form method="post" action="/../app/levelUp_finalize.php" class="heroStatForm">
        <h4>Spend <?= $skillPoints; ?> points on Attributes and Skills</h4>
        <div class="statContainer">
            <div class="baseStats">
                <h3>Base Attributes</h3>
                <div class="stat">
                    <label for="strength">Strength: <?= $player->getStrength(); ?></label>
                    <input type="number" name="strength" id="strength">
                </div>
                <div class="stat">
                    <label for="speed">Speed: <?= $player->getSpeed(); ?></label>
                    <input type="number" name="speed" id="speed">
                </div>
                <div class="stat">
                    <label for="vitality">Vitality: <?= $player->getVitality(); ?></label>
                    <input type="number" name="vitality" id="vitality">
                </div>
            </div>
            <div class="skills">
                <h3>Hero Skills</h3>
                <?php foreach ($player->getSkills() as $skill) :
                    switch ($skill->name):
                        case 'Evasion': ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $player->getEvasion(); ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>">
                            </div>
                        <?php break;
                        case 'Initiative': ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $player->getInitiative(); ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>">
                            </div>
                        <?php break;
                        case 'Block': ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $player->getBlock(); ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>">
                            </div>
                        <?php break;
                        default: ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $skill->value; ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>">
                            </div>
                <?php break;
                    endswitch;
                endforeach; ?>
            </div>
        </div>
        <button type="submit" name="confirm">Confirm</button>
    </form>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
