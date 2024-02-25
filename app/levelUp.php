<?php

require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/levelUpFunctions.php";
require __DIR__ . "/../functions/armory.php";

if (!isset($_SESSION['player'])) {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}

if (!isset($_SESSION['levelUp']) || !$_SESSION['levelUp'] === true) {
    header('Location:' . $baseURL . '/app/playerHero.php');
    exit();
}

$player = loadHero($database);
saveHero($player, $database);

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
    <form method="post" action="<?= $baseURL; ?>/app/levelUp_finalize.php" class="heroStatForm">
        <h4>Spend <?= $skillPoints; ?> points on Attributes and Skills</h4>
        <div>
            <!-- Using the hidden input field to make skillpoint value readable by skillCounter.js -->
            <input id=maxPoints type="hidden" value="<?= $skillPoints; ?>">
            <p id="skillPointCounter">Points remaining: <?= $skillPoints; ?></p>
        </div>
        <div class="statContainer">
            <div class="baseStats">
                <h3>Base Attributes</h3>
                <div class="stat">
                    <label for="strength">Strength: <?= $player->getStrength(); ?></label>
                    <input type="number" name="strength" id="strength" class="attribute" min="0" max="20">
                </div>
                <div class="stat">
                    <label for="speed">Speed: <?= $player->getSpeed(); ?></label>
                    <input type="number" name="speed" id="speed" class="attribute" min="0" max="20">
                </div>
                <div class="stat">
                    <label for="vitality">Vitality: <?= $player->getVitality(); ?></label>
                    <input type="number" name="vitality" id="vitality" class="attribute" min="0" max="20">
                </div>
            </div>
            <div class="skills">
                <h3>Hero Skills</h3>
                <?php foreach ($player->getSkills() as $skill) :
                    switch ($skill->name):
                        case 'Evasion': ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $player->getEvasion(); ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>" class="skill" min="0" max="20">
                            </div>
                        <?php break;
                        case 'Initiative': ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $player->getInitiative(); ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>" class="skill" min="0" max="20">
                            </div>
                        <?php break;
                        case 'Block': ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $player->getBlock(); ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>" class="skill" min="0" max="20">
                            </div>
                        <?php break;
                        default: ?>
                            <div class="stat">
                                <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ": " . $skill->value; ?></label>
                                <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>" class="skill" min="0" max="20">
                            </div>
                <?php break;
                    endswitch;
                endforeach; ?>
            </div>
        </div>
        <button type="submit" name="confirm">Confirm</button>
    </form>
</main>
<script src="<?= $baseURL; ?>/styles/skillCounter.js"></script>
<?php
require __DIR__ . "/../nav/footer.php";
