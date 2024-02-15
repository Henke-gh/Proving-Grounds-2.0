<?php
require __DIR__ . "/../bootstrap.php";
session_start();

$date = date("Y-m-d");

use App\Hero;

$_SESSION['player'] = $database->getHero($_SESSION['playerID']);
$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

if ($player->isDead()) {
    $database->writeOnTombstone($_SESSION['playerID'], $player->name, $player->getLevel(), $date);
    $database->deleteHero($_SESSION['playerID']);
    unset($_SESSION['player']);
}

$combatLog = $_SESSION['playerDeath'];

require_once __DIR__ . "/../nav/header.php";
?>

<main>
    <h1>You have perished..</h1>
    <img class="graveyardImg" src="/../assets/images/player_death_small.png">

    <div class="combatlog">
        <?php foreach ($combatLog as $line) : ?>
            <p class="cursive logLine"><?= $line; ?></p>
        <?php endforeach; ?>
        <p class="cursive">Your bravery will be remembered.</p>
    </div>
    <form action="/app/heroCreation_step1.php" method="post">
        <button type="submit" name="endSession">Create new Hero</button>
    </form>
</main>

<?php
require_once __DIR__ . "/../nav/footer.php";
