<?php
//_step2 of character creation initializes the Hero-class instance and handles distribution of starting stats.
require __DIR__ . "/../vendor/autoload.php";
session_start();

use App\Hero;
use App\Skill;

if (isset($_POST['createHero'])) {
    $name = trim(htmlspecialchars($_POST['heroName'], ENT_QUOTES));
    $gender = ucfirst($_POST['heroGender']);
    $player = new Hero($name, $gender);

    $_SESSION['player'] = $player->saveHeroState();
} elseif (isset($_SESSION['heroCreation'])) {
    $playerSaveState = $_SESSION['player'];
    $player = new Hero($playerSaveState['name'], $playerSaveState['gender']);

    $_SESSION['player'] = $player->saveHeroState();
} else {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}

$skillPoints = 50;

require __DIR__ . "/../nav/header.php";
?>

<main>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="errorMsg">
            <h3><?= $_SESSION['error']; ?></h3>
        </div>
    <?php
        unset($_SESSION['error']);
    endif; ?>
    <h2>Character Creation</h2>
    <div class="heroSummary">
        <h3>Name: <?= $player->name; ?></h3>
        <p>Gender: <?= $player->gender; ?></p>
    </div>
    <form method="post" action="/../app/heroCreation_finalize.php" class="heroStatForm">
        <h4>Spend <?= $skillPoints; ?> points on Attributes and Skills</h4>
        <div class="statContainer">
            <div class="baseStats">
                <h3>Base Attributes</h3>
                <div class="stat">
                    <label for="strength">Strength:</label>
                    <input type="number" name="strength" id="strength">
                </div>
                <div class="stat">
                    <label for="speed">Speed:</label>
                    <input type="number" name="speed" id="speed">
                </div>
                <div class="stat">
                    <label for="vitality">Vitality:</label>
                    <input type="number" name="vitality" id="vitality">
                </div>
            </div>
            <div class="skills">
                <h3>Hero Skills</h3>
                <?php foreach ($player->getSkills() as $skill) : ?>
                    <div class="stat">
                        <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ":"; ?></label>
                        <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" name="create">Create Hero</button>
    </form>
</main>

<?php
require __DIR__ . "/../nav/footer.html";
