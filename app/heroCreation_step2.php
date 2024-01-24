<?php
//_step2 of character creation initializes the Hero-class instance and handles distribution of starting stats.
require __DIR__ . "/../vendor/autoload.php";

use App\Hero;
use App\Monster;
use App\Weapon;
use App\Skill;

if (isset($_POST['createHero'])) {
    $name = trim(htmlspecialchars($_POST['heroName'], ENT_QUOTES));
    $gender = ucfirst($_POST['heroGender']);
    $player = new Hero($name, $gender);
    $player->addSkill(new Skill("Swords", 15));
} else {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}


$starterSword = new Weapon("Short Sword", "Swords", 2, 4);
$starterAxe = new Weapon("Hand Axe", "Axe", 2, 5);
$starterSpear = new Weapon("Short Spear", "Spear", 1, 6);

$weapons = [$starterSword, $starterAxe, $starterSpear];

require __DIR__ . "/../nav/header.php";
?>

<main>
    <h2>Character Creation</h2>
    <div class="heroSummary">
        <h3><?= $player->name; ?></h3>
        <p><?= $player->gender; ?></p>
    </div>
    <form>
        <div class="baseStats">
        </div>
        <div class="Weapon Select">
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
        </div>
        <button>Create Hero</button>
    </form>
</main>

<?php
require __DIR__ . "/../nav/footer.html";
