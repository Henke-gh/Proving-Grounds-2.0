<?php

require __DIR__ . "/bootstrap.php";
require __DIR__ . "/functions/armory.php";
$users = $database->getUsernames();
$testHero = [
    'name' => 'Bob',
    'level' => 5,
    'items' =>
    [
        'weapon' => 'axe',
        'shield' => 'buckler'
    ]
];
$heroJSON = json_encode($testHero);
//$database->addHero(1, $heroJSON, 1);
$hero = $database->getHero(1);
var_dump($hero);
require __DIR__ . "/nav/header.php";
?>
<main>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li><?= $user; ?></li>
        <?php endforeach; ?>
    </ul>
</main>