<?php
//_step3 is cosmetic. A short summary of the player Hero's stats and a welcome screen with hints.
require __DIR__ . "/../vendor/autoload.php";
session_start();

$player = $_SESSION['player'];

echo '<pre>';
var_dump($player);

use App\Hero;
use App\Skill;

if (isset($_POST['create'])) {
    $pointsSpent = 0;
    foreach ($_POST as $stat => $value) {
        if ($stat !== 'create' && $value > 0) {
            $pointsSpent += $value;
            echo "Key: $stat, Value: $value <br>";
        }
    }
    if ($pointsSpent > 25) {
        echo "Not enough skill points!";
    } else if ($pointsSpent < 25) {
        echo "Make sure to spend all your skill points!";
    } else {
        echo $pointsSpent . " points spent!";
    }
}

require __DIR__ . "/../nav/header.php";

?>
<main>
    <h2>Final Char Creation Screen</h2>
    <p><?= $player->name; ?></p>
</main>
<?php
require __DIR__ . "/../nav/footer.html";
