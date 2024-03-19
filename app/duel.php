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

if (isset($_POST['select'])) {
    $_SESSION['opponentID'] = (int) htmlspecialchars($_POST['select'], ENT_QUOTES);
    $_SESSION['opponent'] = $database->getHero($_SESSION['opponentID']);

    //$opponent = loadOpponent($database);
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

        <?php if (isset($POST['select'])) : ?>
            <p><?= $POST['select']; ?></p>
            <p><?= $opponent->name; ?> selected!</p>
        <?php endif; ?>

        <?php $opponents = $database->getAllFromTable('heroes');
        foreach ($opponents as $opponent) :
            $heroChamp = unserialize($opponent['heroData']);
            if ($heroChamp['name'] !== $player->name) : ?>
                <form method="post" action="">
                    <div class="selectHero">
                        <p>[ID: <?= $opponent['ID']; ?>] <?= $heroChamp['name'] . " - [" . $heroChamp['level'] . "]"; ?></p>
                        <input type="hidden" value="<?= $opponent['ID']; ?>">
                        <button type="submit" name="select">Select</button>
                    </div>
                </form>
        <?php endif;
        endforeach; ?>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<?php
require __DIR__ . "/../nav/footer.php";
