<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proving Grounds</title>
    <link rel="stylesheet" href="<?= $baseURL; ?>/styles/avatarSelectionStyle.css" />
    <link rel="stylesheet" href="<?= $baseURL; ?>/styles/style.css?v=2" />
    <link rel="icon" type="image/x-icon" href="<?= $baseURL; ?>/assets/images/icons/favIcon.png" />
</head>

<body>
    <header class="mainHeader">
        <?php if (isset($_SESSION['playerID'])) : ?>
            <a href="<?= $baseURL; ?>/app/playerHero.php">
                <h1>The Proving Grounds</h1>
            </a>
        <?php else : ?>
            <a href="<?= $baseURL; ?>/index.php">
                <h1>The Proving Grounds</h1>
            </a>
        <?php endif; ?>
        <img src="<?= $baseURL; ?>/assets/images/menu.svg" class="hidden burgerIcon">
    </header>
    <div class="mobileMenu hidden">
        <nav>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <div class="gameMenuSmall">
                    <h3>Game</h3>
                    <div class="gameMenuItem">
                        <a href="<?= $baseURL; ?>/app/playerHero.php" class="navLink gameLink"><img src="<?= $baseURL; ?>/assets/images/icons/heroIcon.svg" alt="Hero" /></a>
                        <a href="<?= $baseURL; ?>/app/playerHero.php" class="navLink gameLink">[Hero]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="<?= $baseURL; ?>/app/combat.php" class="navLink gameLink"><img src="<?= $baseURL; ?>/assets/images/icons/IconFrameCombat.svg" alt="Combat" /></a>
                        <a href="<?= $baseURL; ?>/app/combat.php" class="navLink gameLink">[Combat]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="<?= $baseURL; ?>/app/shop.php" class="navLink gameLink"><img src="<?= $baseURL; ?>/assets/images/icons/IconFrameShop.svg" alt="Shop" /></a>
                        <a href="<?= $baseURL; ?>/app/shop.php" class="navLink gameLink">[Shop]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="<?= $baseURL; ?>/app/hospital.php" class="navLink gameLink"><img src="<?= $baseURL; ?>/assets/images/icons/IconFrameHealing.svg" alt="Healing" /></a>
                        <a href="<?= $baseURL; ?>/app/hospital.php" class="navLink gameLink">[Healing]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="<?= $baseURL; ?>/app/tavern.php" class="navLink gameLink"><img src="<?= $baseURL; ?>/assets/images/icons/IconFrameTavern.svg" alt="Tavern" /></a>
                        <a href="<?= $baseURL; ?>/app/tavern.php" class="navLink gameLink">[Tavern]</a>
                    </div>
                </div>
            <?php else : ?>
                <a href="<?= $baseURL; ?>/index.php" class="navLink">Start</a>
            <?php endif; ?>
            <h3>Site Nav</h3>
            <div class="gameMenuSmall">
                <a href="<?= $baseURL; ?>/app/gameguide.php" class="navLink">Game Guide</a>
                <a href="<?= $baseURL; ?>/app/tombstone.php" class="navLink">Tombstone</a>
                <?php if (isset($_SESSION['playerID'])) : ?>
                    <a href="<?= $baseURL; ?>/app/register.php" class="navLink">My Account</a>
                    <form method="post" action="<?= $baseURL; ?>/app/logout.php">
                        <button type="submit" name="logout">Log Out</button>
                    </form>
                <?php else : ?>
                    <a href="<?= $baseURL; ?>/app/register.php" class="navLink">Register</a>
                <?php endif; ?>
                <a href="#" class="navLink">About</a>
            </div>
        </nav>
    </div>