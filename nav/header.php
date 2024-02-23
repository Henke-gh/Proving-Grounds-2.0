<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proving Grounds</title>
    <link rel="stylesheet" href="/styles/avatarSelectionStyle.css" />
    <link rel="stylesheet" href="/styles/style.css" />
</head>

<body>
    <header class="mainHeader">
        <?php if (isset($_SESSION['playerID'])) : ?>
            <a href="/../app/playerHero.php">
                <h1>The Proving Grounds</h1>
            </a>
        <?php else : ?>
            <a href="/../index.php">
                <h1>The Proving Grounds</h1>
            </a>
        <?php endif; ?>
        <img src="/../assets/images/menu.svg" class="hidden burgerIcon">
    </header>

    <div class="mobileMenu hidden">
        <nav>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <div class="gameMenuSmall">
                    <h3>Game</h3>
                    <div class="gameMenuItem">
                        <a href="/../app/playerHero.php" class="navLink gameLink"><img src="/../assets/images/icons/IconFrameHero.svg" alt="Hero" /></a>
                        <a href="/../app/playerHero.php" class="navLink gameLink">[Hero]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="/../app/combat.php" class="navLink gameLink"><img src="/../assets/images/icons/IconFrameCombat.svg" alt="Combat" /></a>
                        <a href="/../app/combat.php" class="navLink gameLink">[Combat]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="/../app/shop.php" class="navLink gameLink"><img src="/../assets/images/icons/IconFrameShop.svg" alt="Shop" /></a>
                        <a href="/../app/shop.php" class="navLink gameLink">[Shop]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="/../app/hospital.php" class="navLink gameLink"><img src="/../assets/images/icons/IconFrameHealing.svg" alt="Healing" /></a>
                        <a href="/../app/hospital.php" class="navLink gameLink">[Healing]</a>
                    </div>
                    <div class="gameMenuItem">
                        <a href="/../app/tavern.php" class="navLink gameLink"><img src="/../assets/images/icons/IconFrameTavern.svg" alt="Tavern" /></a>
                        <a href="/../app/tavern.php" class="navLink gameLink">[Tavern]</a>
                    </div>
                </div>
            <?php else : ?>
                <a href="/../index.php" class="navLink">Start</a>
            <?php endif; ?>
            <h3>Site Nav</h3>
            <div class="gameMenuSmall">
                <a href="#" class="navLink">About</a>
                <a href="#" class="navLink">Game Guide</a>
                <?php if (isset($_SESSION['playerID'])) : ?>
                    <a href="/../app/tombstone.php" class="navLink">Tombstone</a>
                    <a href="/../app/register.php" class="navLink">My Account</a>
                    <form method="post" action="/../app/logout.php">
                        <button type="submit" name="logout">Log Out</button>
                    </form>
                <?php else : ?>
                    <a href="/../app/register.php" class="navLink">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>