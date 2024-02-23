<?php

require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/armory.php";
require __DIR__ . "/../functions/healingItems.php";

if (!isset($_SESSION['player'])) {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}

$player = loadHero($database);
saveHero($player, $database);

require __DIR__ . "/../app/playerEquips.php";

if (isset($_POST['getHeal'])) {
    $boughtItem = $_POST['getHeal'];

    foreach ($healingItems as $item) {
        if ($item['name'] === $boughtItem && $player->getGold() >= $item['cost']) {
            $player->setCurrentHP($player->getCurrentHP() + $item['value']);
            $player->setGold($player->getGold() - $item['cost']);
            saveHero($player, $database);
            echo "You bought " . $item['name'];
            break;
        } elseif ($item['name'] === $boughtItem && $player->getGold() < $item['cost']) {
            echo "You can't afford that.";
        }
    }
}

//Only for testing. Sets both HP and Grit to Max.
if (isset($_POST['heal'])) {
    $player->setCurrentHP($player->getHP());
    $player->setCurrentGrit($player->getGrit());
    saveHero($player, $database);
}

require __DIR__ . "/../nav/header.php";
?>
<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <!-- Test version - Heals full HP and Grit -->
        <form method="post">
            <button type="submit" name="heal">Heal All</button>
        </form>

        <div class="hospitalContainer">
            <form method="post">
                <?php foreach ($healingItems as $item) : ?>
                    <button type="submit" name="getHeal" value="<?= $item['name']; ?>"><?= $item['name']; ?></button>
                <?php endforeach; ?>
            </form>
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
