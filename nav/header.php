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
        <nav>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/playerHero.php" class="navLink">Hero</a>
            <?php else : ?>
                <a href="/../index.php" class="navLink">Start</a>
            <?php endif; ?>
            <a href="#" class="navLink">About</a>
            <a href="#" class="navLink">Game Guide</a>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/tombstone.php" class="navLink">Tombstone</a>
                <a href="/../app/register.php" class="navLink">My Account</a>
            <?php else : ?>
                <a href="/../app/register.php" class="navLink">Register</a>
            <?php endif; ?>
        </nav>
        <img src="/../assets/images/menu.svg" class="hidden burgerIcon">
    </header>
    <div class="mobileMenu hidden">
        <nav>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/playerHero.php" class="navLink">Hero</a>
            <?php else : ?>
                <a href="/../index.php" class="navLink">Start</a>
            <?php endif; ?>
            <a href="#" class="navLink">About</a>
            <a href="#" class="navLink">Game Guide</a>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/tombstone.php" class="navLink">Tombstone</a>
                <a href="/../app/register.php" class="navLink">My Account</a>
            <?php else : ?>
                <a href="/../app/register.php" class="navLink">Register</a>
            <?php endif; ?>
        </nav>
    </div>