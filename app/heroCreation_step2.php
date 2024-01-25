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
    $player->addSkill(new Skill("Swords", 0));
    $player->addSkill(new Skill("Axes", 0));
    $player->addSkill(new Skill("Spears", 0));
    $player->addSkill(new Skill("Hammers", 0));
    $player->addSkill(new Skill("Daggers", 0));
    $player->addSkill(new Skill("Evasion", 0));
    $player->addSkill(new Skill("Initiative", 0));
    $player->addSkill(new Skill("Block", 0));

    $_SESSION['player'] = $player;
} else {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}

require __DIR__ . "/../nav/header.php";
?>

<main>
    <h2>Character Creation</h2>
    <div class="heroSummary">
        <h3><?= $player->name; ?></h3>
        <p><?= $player->gender; ?></p>
    </div>
    <form method="post" action="/../app/heroCreation_step3.php">
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

/* <div class="Weapon Select">
<h3>Select a new weapon</h3>
<select name="weapon">
<?php
$weaponIndex = 0;
foreach ($weapons as $weapon) : ?>
    <option value="<?= $weaponIndex; ?>">
    <h4><?= $weapon->name ?></h4>
    <p><?= " - (" . $weapon->minDamage . "-" . $weapon->maxDamage . ")" ?></p>
    </option>
    <?php
    $weaponIndex++;
endforeach; ?>
</select>
</div> */
