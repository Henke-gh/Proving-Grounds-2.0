<?php

declare(strict_types=1);

require __DIR__ . "/../bootstrap.php";

if (isset($_SESSION['playerID'])) {

    if (isset($_POST['deleteHero'])) {
        $id = $_SESSION['playerID'];
        $database->deleteHero($id);
        unset($_SESSION['player']);
        if (isset($_SESSION['levelUp'])) {
            unset($_SESSION['levelUp']);
        }
        header('Location:' . $baseURL . '/app/heroCreation_step1.php');
        exit();
    }
} else {
    header('Location:' . $baseURL . '/index.php');
    exit();
}
