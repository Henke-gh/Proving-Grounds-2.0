<?php
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";
require __DIR__ . "/../app/monsterLibrary.php";
require __DIR__ . "/../functions/combatLogic.php";
require __DIR__ . "/../functions/levelUpFunctions.php";

if (!isset($_SESSION['player'])) {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}
$player = loadHero($database);
saveHero($player, $database);

require __DIR__ . "/../app/playerEquips.php";

levelUp($player);

if (isset($_POST['fight'])) {
    $stance = $_POST['combatStance'];
    $retreat = (int) $_POST['retreatValue'];
    unset($_POST['combatStance']);
    unset($_POST['retreatValue']);
    $selectedMonsterID = $_POST['fight'];
    if ($player->getCurrentGrit() > 0) {
        $selectedMonster = $monsterLibrary->getMonster($selectedMonsterID);
        $combatLog = doBattle($player, $selectedMonster, $retreat, $stance);
        saveHero($player, $database);
        //if the player dies during combat, user is sent directly to death screen.
        if ($player->isDead()) {
            header('Location: /../app/death.php');
            exit();
        }
    } else {
        unset($_POST['fight']);
        $_SESSION['error'] = "You're too tired to fight..";
    }
}

if (isset($_POST['back'])) {
    levelUp($player);
    unset($_POST['fight']);
}
require __DIR__ . "/../nav/header.php";
?>

<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <?php if (!isset($_POST['fight'])) :

            if (isset($_SESSION['error'])) : ?>
                <div class="errorMsg">
                    <h3><?= $_SESSION['error']; ?></h3>
                </div>
            <?php
                unset($_SESSION['error']);
            endif;
            ?>
            <div class="monsterSelect">
                <h2>Duke Rorfetch's Arena</h2>
                <div class="combatImgContainer">
                    <img src="/../assets/images/scout_sharp.png" />
                </div>
                <p>Enter, if you dare, and claim your fame!</p>
                <div class="monsterSelector">
                    <?php $monsterID = 0;
                    foreach ($monsterLibrary->getAllMonsters() as $monster) : ?>
                        <!-- Reuses the shopItem.js solution for displaying monster info & combat options -->
                        <div class="monster shopItem">
                            <div class="itemSelect">
                                <p>[Level: <?= $monster->getLevel(); ?>] - <span class="bold"><?= $monster->name; ?></span></p>
                                <button class="showItem">Show</button>
                            </div>
                            <div class="itemDetails hidden">
                                <div class="descriptionBox">
                                    <p><span class="bold">Weapon:</span> <?= $monster->weapon->name; ?></p>
                                    <?php if (isset($monster->shield)) : ?>
                                        <p><span class="bold">Shield:</span> <?= $monster->shield->name; ?></p>
                                    <?php endif; ?>
                                    <?php if (isset($monster->armour)) : ?>
                                        <p><span class="bold">Armour:</span> <?= $monster->armour->name; ?></p>
                                    <?php endif; ?>
                                    <p class="cursive">-<?= $monster->getDescription(); ?></p>
                                </div>
                                <form method="post" class="combatForm">
                                    <label for="combatStance">Combat Stance</label>
                                    <select name="combatStance" id="combatStance">
                                        <option value="light">Fast Attacks</option>
                                        <option value="balanced" selected>Balanced</option>
                                        <option value="defensive">Heavy Guard</option>
                                    </select>
                                    <label for="hpSelect">Retreat at:</label>
                                    <select name=retreatValue id=hpSelect>
                                        <?php
                                        $retreat = 100;
                                        for ($i = 0; $i < 11; $i++) :
                                            if ($retreat === 50) : ?>
                                                <option selected><?= $retreat; ?>% HP</option>
                                            <?php else : ?>
                                                <option><?= $retreat; ?>% HP</option>
                                        <?php
                                            endif;
                                            $retreat -= 10;
                                        endfor; ?>
                                    </select>
                                    <button type="submit" name="fight" value="<?= $monsterID; ?>">Fight</button>
                                </form>
                            </div>
                        </div>
                    <?php
                        $monsterID++;
                    endforeach; ?>
                </div>
            </div>
            <div class="combatImgContainer">
                <img src="/../assets/images/goblin_fighter_sharp.png" />
            </div>
            <script src="/styles/shopItems.js"></script>

        <?php elseif (isset($_POST['fight'])) : ?>
            <div class="combatlog">
                <?php foreach ($combatLog as $line) : ?>
                    <p class="cursive logLine"><?= $line; ?></p>
                <?php endforeach; ?>
                <form method="post">
                    <button type="submit" name="back">Continue</button>
                </form>
            </div>
        <?php endif; ?>
    </main>
    <div class="heroCardPosition">
        <?php
        require __DIR__ . "/../app/playerSummary.php";
        ?>
    </div>
</div>
<?php
require __DIR__ . "/../nav/footer.php";
