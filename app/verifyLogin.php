<?php

declare(strict_types=1);

//database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
    $password = trim(htmlspecialchars($_POST['password'], ENT_QUOTES));
    unset($_POST['password']);

    header('Location: /../app/playerHero.php');
}
