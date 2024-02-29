<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../app/monsterLibrary.php";
require __DIR__ . "/../functions/prizefight.php";
require __DIR__ . "/../functions/levelUpFunctions.php";
//Not implemented - Work in progress! Do not push to live!

if (!isset($_SESSION['playerID'])) {
    header('Location:' . $baseURL . '/index.php');
    exit();
}

if (!isset($_SESSION['player']['weapon'])) {
    header('Location:' . $baseURL . '/app/heroCreation_step1.php');
    exit();
}
$player = loadHero($database);
saveHero($player, $database);

require __DIR__ . "/../app/playerEquips.php";

levelUp($player);

require __DIR__ . "/../nav/header.php";
?>
<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <div>
            <?= $target->name; ?>
            <?php $target->setCurrentHP(0); ?>
        </div>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<?php
require __DIR__ . "/../nav/footer.php";
