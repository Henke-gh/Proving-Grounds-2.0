<?php
require __DIR__ . "/vendor/autoload.php";

use App\Hero;
use App\Monster;
use App\Weapon;
use App\Skill;

$player = new Hero("Des", "Female");
$player->addSkill(new Skill("Swords", 15));

$starterSword = new Weapon("Short Sword", "Swords", 2, 4);
$starterAxe = new Weapon("Hand Axe", "Axe", 2, 5);
$starterSpear = new Weapon("Short Spear", "Spear", 1, 6);

$weapons = [$starterSword, $starterAxe, $starterSpear];

$goblin = new Monster(
    "Goblin",
    2,
    8,
    15,
    new Weapon("Hatchet", "Axe", 1, 3)
);

$player->updateCurrentHP(5);
$player->updateXP(10);

if (isset($_POST['weapon'])) {
    $weaponIndex = $_POST['weapon'];
    $player->weapon = $weapons[$weaponIndex];
}
require __DIR__ . "/nav/header.php";
?>

<main>
    <div class="container">
        <div class="player">
            <h2><?= $player->name; ?></h2>
            <p>Character:</p>
            <ul>
                <li><?= "HP: " . $player->getCurrentHP() . "/" . $player->getHP(); ?></li>
                <li><?= "Grit: " . $player->getCurrentGrit() . "/" . $player->getGrit(); ?></li>
                <li><?= "Fatigue: " . $player->getFatigue(); ?></li>
                <li><?= "Gold: " . $player->getGold(); ?></li>
                <li><?= "XP: " . $player->getXP(); ?></li>
            </ul>
            <p>Equipment:</p>
            <ul>
                <li><?= "Weapon: " . $player->weapon->name . " (" . $player->weapon->minDamage . "-" . $player->weapon->maxDamage . ")" ?></li>
            </ul>
            <p>Skills:</p>
            <ul>
                <?php foreach ($player->getSkills() as $skill) : ?>
                    <li><?= $skill->name . ": " . $skill->value; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="monster">
            <h2><?= $goblin->name; ?></h2>
            <p>Stats:</p>
            <ul>
                <li><?= "Level: " . $goblin->level; ?></li>
                <li><?= "HP: " . $goblin->hitpoints; ?></li>
                <li><?= "Weapon: " . $goblin->weapon->name; ?></li>
            </ul>
        </div>
    </div>
    <div class="Weapon Select">
        <h3>Select a new weapon</h3>
        <form method="post" action="">
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
            <button type="submit">Select</button>
        </form>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.html";
