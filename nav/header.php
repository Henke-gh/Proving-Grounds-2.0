<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG - 2.0, WIP</title>
    <link rel="stylesheet" href="/styles/style.css" />
    <link rel="stylesheet" href="/styles/avatarSelectionStyle.css" />
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
            <a href="#">Game Guide</a>
            <a href="#">About</a>
            <?php if (isset($_SESSION['playerID'])) : ?>
                <a href="/../app/tombstone.php">Tombstone</a>
                <a href="/../app/register.php">My Account</a>
            <?php else : ?>
                <a href="/../app/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>