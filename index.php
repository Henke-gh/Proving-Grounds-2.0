<?php
require __DIR__ . "/vendor/autoload.php";

use App\Hero;
use App\Monster;
use App\Weapon;
use App\Skill;

$playerHero = new Hero("Des", "Female");
$playerHero->addSkill(new Skill("Swords", 15));

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

$playerHero->updateCurrentHP(5);
$playerHero->updateXP(10);

if (isset($_POST['weapon'])) {
    $weaponIndex = $_POST['weapon'];
    $playerHero->weapon = $weapons[$weaponIndex];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG - 2.0, WIP</title>
    <link rel="stylesheet" href="/styles/style.css" />
</head>

<body>
    <header>
        <h1>The New Proving Grounds</h1>
    </header>
    <main>
        <div class="container">
            <div class="player">
                <h2><?= $playerHero->name; ?></h2>
                <p>Character:</p>
                <ul>
                    <li><?= "HP: " . $playerHero->getCurrentHP() . "/" . $playerHero->getHP(); ?></li>
                    <li><?= "Grit: " . $playerHero->getCurrentGrit() . "/" . $playerHero->getGrit(); ?></li>
                    <li><?= "Fatigue: " . $playerHero->getFatigue(); ?></li>
                    <li><?= "XP: " . $playerHero->getXP(); ?></li>
                </ul>
                <p>Equipment:</p>
                <ul>
                    <li><?= "Weapon: " . $playerHero->weapon->name . " (" . $playerHero->weapon->minDamage . "-" . $playerHero->weapon->maxDamage . ")" ?></li>
                </ul>
                <p>Skills:</p>
                <ul>
                    <?php foreach ($playerHero->getSkills() as $skill) : ?>
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
</body>

</html>