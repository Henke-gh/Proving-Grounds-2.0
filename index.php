<?php
require __DIR__ . "/vendor/autoload.php";

use App\Hero;
use App\Monster;
use App\Weapon;
use App\Skill;

$player = new Hero("Des", "Female");
$player->addSkill(new Skill("Swords", 15));

require __DIR__ . "/app/weaponLibrary.php";

$goblin = new Monster(
    "Goblin",
    2,
    8,
    15,
    new Weapon("Hatchet", "Axe", 1, 3, 666)
);

$player->updateCurrentHP(5);
$player->setXP(10);

//the POST contains a serialized array which in turn contains the two values weapon type and the weapon item's
//relative index.
if (isset($_POST['weapon'])) {
    $selectedWeapon = unserialize($_POST["weapon"]);
    $weaponType = $selectedWeapon['type'];
    $weaponIndex = $selectedWeapon['index'];
    $player->weapon = $weapons[$weaponType][$weaponIndex];
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
                foreach ($weapons as $weaponType => $weaponGroup) :
                    $weaponIndex = 0;
                    //The Option value needs to contain both the weapon type (ie. "Swords") and the items Index relative to the ype
                    //This is why the option value is a serialized array. Weird fix, but it works.
                    foreach ($weaponGroup as $weapon) : ?>
                        <option value="<?= htmlentities(serialize(array('type' => $weaponType, 'index' => $weaponIndex))); ?>">
                            <h4><?= $weapon->name ?></h4>
                            <p><?= " - (" . $weapon->minDamage . "-" . $weapon->maxDamage . ")" ?></p>
                        </option>
                <?php
                        $weaponIndex++;
                    endforeach;
                endforeach; ?>
            </select>
            <button type="submit">Select</button>
        </form>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.html";
