<?php

require __DIR__ . "/bootstrap.php";
require __DIR__ . "/functions/armory.php";
$users = $database->getUsernames();
var_dump($users);
require __DIR__ . "/nav/header.php";
?>
<main>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li><?= $user; ?></li>
        <?php endforeach; ?>
    </ul>
</main>