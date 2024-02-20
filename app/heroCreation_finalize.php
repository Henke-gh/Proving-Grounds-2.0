<?php
//_step3 finalizes hero creation and verifies the player has spent the correct number of skill points.
require __DIR__ . "/../bootstrap.php";

use App\Hero;

$playerSaveState = $_SESSION['player'];
$player = new Hero($playerSaveState['name'], $playerSaveState['gender']);
$player->loadHeroState($playerSaveState);

$skillPoints = 50;

if (isset($_POST['create'])) {
    $pointsSpent = 0;
    $skillUps = [];
    foreach ($_POST as $stat => $value) {
        if ($stat !== 'create' && $value > 0) {
            $pointsSpent += $value;
            $skillUps[$stat] = $value;
        }
    }
    if ($pointsSpent > $skillPoints) {
        $_SESSION['heroCreation'] = 2;
        $_SESSION['error'] = "Not enough skill points!";
        header('Location: /../app/heroCreation_step2.php');
        exit();
    } else if ($pointsSpent < $skillPoints) {
        $_SESSION['heroCreation'] = 2;
        $_SESSION['error'] = "Make sure to spend all your skill points!";
        header('Location: /../app/heroCreation_step2.php');
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
        $_SESSION['player'] = $player->saveHeroState();
        $heroJSON = serialize($_SESSION['player']);
        $database->addHero($_SESSION['playerID'], $heroJSON, 1);
        header('Location: /../app/playerHero.php');
        exit();
    }
}
