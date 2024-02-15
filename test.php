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
$heroJSON = serialize($testHero);
//$database->addHero(1, $heroJSON, 1); Writes to DB, ok.
//$hero = $database->getHero(1);
//$database->updateHero(1, $heroJSON); Updates DB, ok.
$users = $database->getAllFromTable('Users');
echo '<pre>';
var_dump($users);
$date = date("Y-m-d");
$tombstone = $database->getAllFromTable('tombstone');
//$database->writeOnTombstone(3, 'Tern', 10, $date);
echo $date;
require __DIR__ . "/nav/header.php";
?>
<main>
    <ul>
        <?php foreach ($tombstone as $death) : ?>
            <li><?= $death['heroName'] . " - " . $death['heroLevel'] . ", " . $death['date']; ?></li>
        <?php endforeach; ?>
    </ul>
</main>