<div class="heroCard heroShortSummary">
    <img src="<?= $player->getAvatar(); ?>" class="circularImg playerAvatar" title="avatar">
    <div class="heroGeneralStats">
        <p class="bold"><?= $player->name . " - Level: " . $player->getLevel(); ?></p>
        <p class="cursive"><?= $player->getFameTitle() . " (" . $player->getFameScore() . ")"; ?></p>
        <p><span class="bold">HP: </span><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
        <p><span class="bold">Grit: </span><?= $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
        <p><span class="bold">XP: </span><?= $player->getXP() . "/" . $player->getXPtoNext(); ?></p>
        <p><span class="bold">Gold: </span><?= $player->getGold(); ?></p>
    </div>
    <?php
    require __DIR__ . "/../app/levelUpMessage.php"; ?>
</div>