<?php
//_step1 of character creation handles naming of the player hero, gender selection and avatar choice.
require __DIR__ . "/../vendor/autoload.php";

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

require __DIR__ . "/../nav/header.php";
?>

<main>
    <h2>Character Creation</h2>
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
