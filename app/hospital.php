<?php

require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../functions/armory.php";
require __DIR__ . "/../functions/healingItems.php";

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

if (isset($_POST['getHeal'])) {
    $itemIndex = htmlspecialchars($_POST['healingItems'], ENT_QUOTES);
    $item = $healingItems[$itemIndex];

    if ($player->getGold() >= $item['cost']) {
        $preheal = $player->getCurrentHP();
        $valueHeal = $item['value'];
        $currentHP = $preheal + $valueHeal;
        $player->setCurrentHP($currentHP);
        $player->setGold($player->getGold() - $item['cost']);
        saveHero($player, $database);
        $_SESSION['itemBought'] = $player->name . " was healed for " . $item['value'] . " HP.";
    } elseif ($player->getGold() < $item['cost']) {
        $_SESSION['itemBought'] = "Come back when you have a bit more gold, child.";
    }
}
require __DIR__ . "/../nav/header.php";
?>
<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <h2>Schvitzhild's Remedies</h2>
        <?php if (isset($_SESSION['itemBought'])) : ?>
            <div class="successMsg">
                <h3><?= $_SESSION['itemBought']; ?></h3>
            </div>
        <?php
            unset($_SESSION['itemBought']);
        endif; ?>
        <div class="hospitalContainer">
            <img src="<?= $baseURL; ?>/assets/images/hospital.png" class="tavernImage">
            <p>Schvitzhild will fix you right up. Most of the time.</p>
            <div class="hospitalServices">
                <div>
                    <h3>- Available Remedies -</h3>
                    <?php foreach ($healingItems as $item) : ?>
                        <div class="healingItem">
                            <p><span class="bold"><?= $item['name'] ?></span> +<?= $item['value']; ?> HP</p>
                            <p><span class="bold">Cost:</span> <?= $item['cost'] ?> gold</p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <form method="post">
                    <label for="healingItems">
                        <h3>- Select Remedy -</h3>
                    </label>
                    <select name="healingItems" id="healingItems">
                        <?php foreach ($healingItems as $index => $item) : ?>
                            <option value="<?= $index; ?>"><?= $item['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="getHeal">Buy Remedy</button>
                </form>
            </div>
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
