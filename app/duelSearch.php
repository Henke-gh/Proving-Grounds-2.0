<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../app/monsterLibrary.php";
require __DIR__ . "/../functions/combatLogic.php";
require __DIR__ . "/../functions/levelUpFunctions.php";

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

levelUp($player);
require __DIR__ . "/../nav/header.php";
?>

<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <h2>Duel</h2>
        <?php $opponents = $database->getAllFromTable('heroes');
        foreach ($opponents as $opponent) :
            $heroChamp = unserialize($opponent['heroData']); ?>
            <p><?= $heroChamp['name'] . " - [" . $heroChamp['level'] . "]"; ?></p>
        <?php endforeach; ?>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<?php
require __DIR__ . "/../nav/footer.php";
