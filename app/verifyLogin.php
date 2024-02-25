<?php

declare(strict_types=1);
require __DIR__ . "/../bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
    $password = trim(htmlspecialchars($_POST['password'], ENT_QUOTES));
    unset($_POST['password']);
    $users = $database->getAllFromTable('Users');
    foreach ($users as $user) {
        if ($user['Username'] === $username) {
            if (password_verify($password, $user['Password'])) {
                $_SESSION['player'] = $database->getHero($user['ID']);

                if (!empty($_SESSION['player'])) {
                    $_SESSION['playerID'] = $user['ID'];
                    header('Location:' . $baseURL . '/app/playerHero.php');
                    exit();
                }

                $_SESSION['playerID'] = $user['ID'];
                header('Location:' . $baseURL . '/app/heroCreation_step1.php');
                exit();
            } else {
                $_SESSION['loginFailed'] = "Incorrect password.";
                header('Location:' . $baseURL . '/index.php');
                exit();
            }
        } else {
            $_SESSION['loginFailed'] = "No such Username.";
            header('Location:' . $baseURL . '/index.php');
            exit();
        }
    }
} else {
    header('Location:' . $baseURL . '/index.php');
    exit();
}
