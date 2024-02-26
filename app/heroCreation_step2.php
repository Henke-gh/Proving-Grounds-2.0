<?php
//_step2 of character creation initializes the Hero-class instance and handles distribution of starting stats.
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/avatarArray.php";
require __DIR__ . "/../functions/armory.php";

if (!isset($_SESSION['playerID'])) {
    header('Location:' . $baseURL . '/index.php');
    exit();
}

use App\Hero;

if (isset($_POST['createHero'])) {
    $name = trim(htmlspecialchars($_POST['heroName'], ENT_QUOTES));
    $gender = ucfirst($_POST['heroGender']);
    $avatarID = htmlspecialchars($_POST['heroAvatar'], ENT_QUOTES);
    $avatarURL = $avatars[$avatarID]['url'];
    $player = new Hero($name, $gender);
    $player->weapon = $defaultItems['weapon'];
    $player->shield = $defaultItems['shield'];
    $player->armour = $defaultItems['armour'];
    $player->setAvatar($avatarURL);
    $player->setLastRegen(time());
    $_SESSION['player'] = $player->saveHeroState();
    //Re-instances the hero if user spent too many or too few skill points. Try again.
} elseif (isset($_SESSION['heroCreation'])) {
    $playerSaveState = $_SESSION['player'];
    $player = new Hero($playerSaveState['name'], $playerSaveState['gender']);

    $_SESSION['player'] = $player->saveHeroState();
} else {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}
//if this value is updated, also update value at _finalize!
$skillPoints = 50;

require __DIR__ . "/../nav/header.php";
?>

<main>
    <?php
    if (isset($_SESSION['error'])) : ?>
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
    <div class="proTip">
        <p>Tip: Put at least some points into your base attributes and 20 or so points into a Weapon skill of your choosing.</p>
    </div>
    <form method="post" action="<?= $baseURL; ?>/app/heroCreation_finalize.php" class="heroStatForm">
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
                    <label for="strength">Strength:</label>
                    <input type="number" name="strength" id="strength" class="attribute" min="0" max="50">
                </div>
                <div class="stat">
                    <label for="speed">Speed:</label>
                    <input type="number" name="speed" id="speed" class="attribute" min="0" max="50">
                </div>
                <div class="stat">
                    <label for="vitality">Vitality:</label>
                    <input type="number" name="vitality" id="vitality" class="attribute" min="0" max="50">
                </div>
            </div>
            <div class="skills">
                <h3>Hero Skills</h3>
                <?php foreach ($player->getSkills() as $skill) : ?>
                    <div class="stat">
                        <label for="<?= $skill->name; ?>"><?= ucfirst($skill->name) . ":"; ?></label>
                        <input type="number" name="<?= $skill->name; ?>" id="<?= $skill->name; ?>" class="skill" min="0" max="50">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" name="create">Create Hero</button>
    </form>
</main>
<script src="<?= $baseURL; ?>/styles/skillCounter.js"></script>
<?php
require __DIR__ . "/../nav/footer.php";
