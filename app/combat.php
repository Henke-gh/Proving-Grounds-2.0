<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/monsterLibrary.php";
require __DIR__ . "/../functions/combatLogic.php";
session_start();

use App\Hero;
use App\Monster;
use App\MonsterCollection;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if (isset($_POST['fight'])) {
    $stance = $_POST['combatStance'];
    $retreat = (int) $_POST['retreatValue'];
    $selectedMonsterID = $_POST['fight'];
    $selectedMonster = $monsterLibrary->getMonster($selectedMonsterID);
    $combatLog = doBattle($player, $selectedMonster, $retreat);
    $_SESSION['player'] = $player->saveHeroState();
}

if (isset($_POST['back'])) {
    unset($_POST['fight']);
}

require __DIR__ . "/../nav/header.php";
?>

<main>
    <h2>Enter the Arena</h2>
    <?php if (!isset($_POST['fight'])) : ?>
        <div class="heroInfo">
            <p><?= $player->name; ?></p>
            <p><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
            <p><?= $player->weapon->name; ?></p>
        </div>
        <div class="monsterSelect">
            <h3>Monster Rooster</h3>
            <p class="cursive">(Click on a monster for more information)</p>
            <?php $monsterID = 0;
            foreach ($monsterLibrary->getAllMonsters() as $monster) : ?>
                <div class="monster pointer underlineHover" onclick="showDetails(<?= $monsterID++; ?>,
                '<?= $monster->name; ?>',
                '<?= $monster->level; ?>',
                '<?= $monster->weapon->name; ?>',
                '<?= $monster->getDescription(); ?>')">
                    <p>Level: <?= $monster->level; ?> [<?= $monster->name; ?>]</p>
                    <p><?= $monster->getCurrentHP() . "/" . $monster->getHP(); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- More modulo game, Monster info presents here -->
        <div class="overlay" id="overlay">
            <div class="overlayContent" id="overlayContent">
                <div class=" details" id="details">
                    <!-- JS puts item deets here. Similar to shop.php but for monster selection-->
                </div>
                <button class="closeOverlay" id="closeOverlay">Close Overlay</button>
            </div>
        </div>
        <script src="/styles/monsterSelectModulo.js"></script>

    <?php elseif (isset($_POST['fight'])) : ?>
        <div class="combatlog">
            <p><?= $selectedMonster->name . " vs " . $player->name; ?></p>
            <p><?= "Stance: " . ucfirst($stance); ?></p>
            <p><?= "Retreat value: " . $retreat . "% HP"; ?></p>
            <?php foreach ($combatLog as $line) : ?>
                <p class="cursive"><?= $line; ?></p>
            <?php endforeach; ?>
            <form method="post">
                <button type="submit" name="back">Back</button>
            </form>
        </div>
    <?php endif; ?>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
