<?php
session_start();

require __DIR__ . "/../bootstrap.php";

$tombstone = $database->readTombstone();
require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>The Tombstone</h2>
    <p class="cursive">Top 50 highest level hero deaths.</p>
    <ul>
        <?php
        if (!empty($tombstone)) :
            foreach ($tombstone as $slainHero) : ?>
                <li><?= $slainHero['heroName']; ?> <span class="cursive">(level <?= $slainHero['heroLevel']; ?>)</span> - <?= $slainHero['date']; ?></li>
        <?php endforeach;
        endif; ?>
    </ul>

</main>
<?php

require __DIR__ . "/../nav/footer.php";
