<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/monsterLibrary.php";
session_start();

use App\Hero;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if (isset($_POST['fight'])) {
    $selectedMonsterID = $_POST['fight'];
}

require __DIR__ . "/../nav/header.php";
?>

<main>
    <h2>Enter the Arena</h2>
    <div class="monsterSelect">
        <h3>Monster Rooster</h3>
        <p class="cursive">(Click on a monster for more information)</p>
        <?php $monsterID = 0;
        foreach ($monsters as $monster) : ?>
            <div class="monster pointer underlineHover" onclick="showDetails(<?= $monsterID++; ?>,
                '<?= $monster->name; ?>',
                '<?= $monster->level; ?>',
                '<?= $monster->weapon->name; ?>',
                '<?= $monster->getDescription(); ?>')">
                <p>Level: <?= $monster->level; ?> [<?= $monster->name; ?>]</p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- More modulo game, Monster info presents here -->
    <div class="overlay" id="overlay">
        <div class="details" id="details">
            <!-- JS puts item deets here. Similar to shop.php but for monster selection-->
        </div>
    </div>
</main>
<script src="/styles/monsterSelectModulo.js"></script>
<?php
require __DIR__ . "/../nav/footer.html";
