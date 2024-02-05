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
        <h3><?= $player->name; ?></h3>
        <p><?= $player->gender; ?></p>
    </div>
    <form method="post" action="/../app/heroCreation_step3.php">
        <h4>Spend 50 points on attributes and skills</h4>
        <div class="baseStats">
            <h3>Base Attributes</h3>
            <div class="statContainer">
                <p>Strength: <?= $player->getStrength(); ?></p>
                <input type="number" name="strength">
            </div>
            <div class="statContainer">
                <p>Speed: <?= $player->getSpeed(); ?></p>
                <input type="number" name="speed">
            </div>
            <div class="statContainer">
                <p>Vitality: <?= $player->getVitality(); ?></p>
                <input type="number" name="vitality">
            </div>
            <h3>Skills</h3>
            <?php foreach ($player->getSkills() as $skill) : ?>
                <p><?= ucfirst($skill->name) . ": " . $skill->value; ?></p>
                <input type="number" name="<?= $skill->name; ?>">
            <?php endforeach; ?>
            <button type="submit" name="create">Create Hero</button>
        </div>
    </form>
</main>

<?php
require __DIR__ . "/../nav/footer.html";
