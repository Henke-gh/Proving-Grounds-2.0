<?php
require_once __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/heroFunctions.php";

if (!isset($_SESSION['player'])) {
    header('Location: /../app/heroCreation_step1.php');
    exit();
}

$player = loadHero($database);
saveHero($player, $database);

//require __DIR__ . "/../app/playerEquips.php";
require_once __DIR__ . "/../nav/header.php";
?>
<div class="contentPosition">
    <div class="gameNavPosition">
        <?php require __DIR__ . "/../nav/ingameNavbar.php"; ?>
    </div>
    <main>
        <h2>Borkhorst's Lil' Down by the Docks Tavern</h2>
        <div class="tavernContainer">
            <?php if (isset($_SESSION['barComplete'])) : ?>
                <div class="tavernBarWork">
                    <p><?= $_SESSION['barComplete']; ?></p>
                </div>
            <?php endif;
            unset($_SESSION['barComplete']) ?>
            <img src="/../assets/images/tavernkeeper.png" class="tavernImage">
            <article>
                <p>The place has seen better days, most places have. Most places
                    probably don't even come close to this level of misery.</p>
                <p> It's less a place to drink and relax and more of a
                    'You lookin' at me?!' 'You did! I know you did! Do you have ANY idea how badly I can ruin your day?',
                    and then your day gets ruined-kind of place.
                </p>
                <p>Anyway, you're not allowed to drink here. That's what Borkhorst told you the last time
                    you were here, he's an ugly bastard like that. Unfortunately for you he's also a man of his word.
                    He does let you work though, if you're up for it. It ain't much and it's probably not too honest either.
                    But it is most definitely work.
                </p>
                <p>Working for Borkhorst will gain you some gold, at the cost of Grit.</p>
            </article>
            <div class="">
                <!-- playerInfo here -->
            </div>
            <div class="tavernBarWork">
                <p>Spend 35 Grit to earn 15 gold?</p>
                <form method="post" action="/../app/tavernWork.php">
                    <button type="submit" name="barWork">Take a shift</button>
                </form>
                <a href="/app/playerHero.php"><button type="submit" name="back">Back</button></a>
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
require_once __DIR__ . "/../nav/footer.php";
