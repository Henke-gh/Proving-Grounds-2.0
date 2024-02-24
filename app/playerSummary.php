<div class="heroCard heroShortSummary" id="heroSum">
    <img src="<?= $player->getAvatar(); ?>" class="circularImg playerAvatar" title="avatar">
    <div class="heroGeneralStats">
        <p class="bold"><?= $player->name; ?></p>
        <p class="cursive"><?= $player->getFameTitle(); ?></p>
        <p class="bold"><?= "Level: " . $player->getLevel(); ?></p>
    </div>
    <div class="heroGeneralStats">
        <p><span class="bold">HP: </span><?= $player->getCurrentHP() . "/" . $player->getHP(); ?></p>
        <p><span class="bold">Grit: </span><?= $player->getCurrentGrit() . "/" . $player->getGrit(); ?></p>
        <p><span class="bold">XP: </span><?= $player->getXP() . "/" . $player->getXPtoNext(); ?></p>
        <p><span class="bold">Gold: </span><?= $player->getGold(); ?></p>
    </div>
    <?php
    require __DIR__ . "/../app/levelUpMessage.php"; ?>
</div>