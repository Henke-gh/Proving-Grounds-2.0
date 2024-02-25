<?php if (isset($_SESSION['levelUp']) && $_SESSION['levelUp'] === true) : ?>
    <a href="<?= $baseURL; ?>/app/levelUp.php" class="levelUpLink">
        <div class="levelUpMsg">
            <h4>Level Up</h4>
        </div>
    </a>
<?php endif; ?>