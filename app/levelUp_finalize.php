<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/levelUpFunctions.php";

$player = loadHero($database);
saveHero($player, $database);

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
        saveHero($player, $database);
        unset($_SESSION['levelUp']);
        header('Location: /../app/playerHero.php');
        exit();
    }
}
