<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/levelUpFunctions.php";
session_start();

use App\Hero;

$_SESSION['player'] = $database->getHero($_SESSION['playerID']);

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

$player->regenerateHPnGrit();
$_SESSION['player'] = $player->saveHeroState();
$saveHero = serialize($_SESSION['player']);

$database->updateHero($_SESSION['playerID'], $saveHero);

$skillPoints = 20;

if (isset($_POST['confirm']) && $_SESSION['levelUp'] === true) {
    $pointsSpent = 0;
    $skillUps = [];
    foreach ($_POST as $stat => $value) {
        if ($stat !== 'create' && $value > 0) {
            $pointsSpent += $value;
            $skillUps[$stat] = $value;
        }
    }
    if ($pointsSpent > $skillPoints) {
        $_SESSION['error'] = "Not enough skill points!";
        header('Location: /../app/levelUp.php');
        exit();
    } else if ($pointsSpent < $skillPoints) {
        $_SESSION['error'] = "Make sure to spend all your skill points!";
        header('Location: /../app/levelUp.php');
        exit();
    } else {
        foreach ($skillUps as $skill => $value) {
            switch ($skill) {
                case 'strength':
                    $player->setStrength($value);
                    break;
                case 'speed':
                    $player->setSpeed($value);
                    break;
                case 'vitality':
                    $player->setVitality($value);
                    break;

                default:
                    $player->setSkill($skill, $value);
                    break;
            }
        }
        $player->updateDerivedStats();
        getNextLevelXp($player, $levels);
        increaseFame($player, $fameLevels);
        $_SESSION['player'] = $player->saveHeroState();
        $saveHero = serialize($_SESSION['player']);
        $database->updateHero($_SESSION['playerID'], $saveHero);
        unset($_SESSION['levelUp']);
        header('Location: /../app/playerHero.php');
        exit();
    }
}
