<?php if (isset($_SESSION['levelUp']) && $_SESSION['levelUp'] === true) : ?>
    <div class="levelUpMsg">
        <h4>You gained a new level</h4>
        <a href="/app/levelUp.php">Click to level up</a>
    </div>
<?php endif; ?>