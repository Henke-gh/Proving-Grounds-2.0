<?php

require __DIR__ . "/bootstrap.php";
require __DIR__ . "/functions/armory.php";
$users = $database->getUsernames();
$testHero = [
    'name' => 'Bob',
    'level' => 6,
    'items' =>
    [
        'weapon' => 'sword',
        'shield' => 'buckler'
    ]
];
$heroJSON = json_encode($testHero);
//$database->addHero(1, $heroJSON, 1); Writes to DB, ok.
$hero = $database->getHero(1);
//$database->updateHero(1, $heroJSON); Updates DB, ok.
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