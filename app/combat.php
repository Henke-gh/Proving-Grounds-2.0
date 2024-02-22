<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../app/monsterLibrary.php";
require __DIR__ . "/../functions/combatLogic.php";
require __DIR__ . "/../functions/levelUpFunctions.php";

if (!isset($_SESSION['player'])) {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}
$player = loadHero($database);
saveHero($player, $database);

require __DIR__ . "/../app/playerEquips.php";

levelUp($player);

if (isset($_POST['fight'])) {
    $stance = $_POST['combatStance'];
    $retreat = (int) $_POST['retreatValue'];
    unset($_POST['combatStance']);
    unset($_POST['retreatValue']);
    $selectedMonsterID = $_POST['fight'];
    if ($player->getCurrentGrit() > 0) {
        $selectedMonster = $monsterLibrary->getMonster($selectedMonsterID);
        $combatLog = doBattle($player, $selectedMonster, $retreat);
        saveHero($player, $database);
        //if the player dies during combat, user is sent directly to death screen.
        if ($player->isDead()) {
            header('Location: /../app/death.php');
            exit();
        }
    } else {
        unset($_POST['fight']);
        $_SESSION['error'] = "You're too tired to fight..";
    }
}

if (isset($_POST['back'])) {
    levelUp($player);
    unset($_POST['fight']);
}
require __DIR__ . "/../nav/header.php";
?>

<main>
    <?php if (!isset($_POST['fight'])) :
        require __DIR__ . "/../nav/ingameNavbar.php";
        require __DIR__ . "/../app/playerSummary.php";

        if (isset($_SESSION['error'])) : ?>
            <div class="errorMsg">
                <h3><?= $_SESSION['error']; ?></h3>
            </div>
        <?php
            unset($_SESSION['error']);
        endif;
        ?>
        <div class="monsterSelect">
            <h3>Monster Rooster</h3>
            <p class="cursive">(Click on a monster for more information)</p>
            <?php $monsterID = 0;
            foreach ($monsterLibrary->getAllMonsters() as $monster) : ?>
                <div class="monster pointer underlineHover" onclick="showDetails(<?= $monsterID++; ?>,
                '<?= $monster->name; ?>',
                '<?= $monster->getLevel(); ?>',
                '<?= $monster->weapon->name; ?>',
                '<?= $monster->getDescription(); ?>')">
                    <p>Level: <?= $monster->getLevel(); ?> [<?= $monster->name; ?>]</p>
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
            <?php foreach ($combatLog as $line) : ?>
                <p class="cursive logLine"><?= $line; ?></p>
            <?php endforeach; ?>
            <form method="post">
                <button type="submit" name="back">Continue</button>
            </form>
        </div>
    <?php endif; ?>
</main>
<?php
require __DIR__ . "/../nav/footer.php";
