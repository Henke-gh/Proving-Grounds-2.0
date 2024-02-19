<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG - 2.0, WIP</title>
    <link rel="stylesheet" href="/styles/avatarSelectionStyle.css" />
    <link rel="stylesheet" href="/styles/style.css" />
</head>

<body>
    <header class="mainHeader">
        <h1>The New Proving Grounds</h1>
        <nav>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/playerHero.php">Hero</a>
            <?php else : ?>
                <a href="/../index.php">Start</a>
            <?php endif; ?>
            <a href="#">About</a>
            <a href="#">Game Guide</a>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/tombstone.php">Tombstone</a>
                <a href="/../app/register.php">My Account</a>
            <?php else : ?>
                <a href="/../app/register.php">Register</a>
            <?php endif; ?>
        </nav>
        <img src="/../assets/images/menu.svg" class="hidden burgerIcon">
    </header>
    <div class="mobileMenu hidden">
        <nav>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/playerHero.php">Hero</a>
            <?php else : ?>
                <a href="/../index.php">Start</a>
            <?php endif; ?>
            <a href="#">About</a>
            <a href="#">Game Guide</a>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/tombstone.php">Tombstone</a>
                <a href="/../app/register.php">My Account</a>
            <?php else : ?>
                <a href="/../app/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>