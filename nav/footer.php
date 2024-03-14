<footer>
    <nav class="footerNav">
        <?php if (isset($_SESSION['playerID'])) : ?>
            <a href="<?= $baseURL; ?>/app/playerHero.php" class="navLink">Hero</a>
        <?php else : ?>
            <a href="<?= $baseURL; ?>/index.php" class="navLink">Start</a>
        <?php endif; ?>
        <a href="#" class="navLink">About</a>
        <a href="<?= $baseURL; ?>/app/gameguide.php" class="navLink">Game Guide</a>
        <?php if (isset($_SESSION['playerID'])) : ?>
            <a href="<?= $baseURL; ?>/app/tombstone.php" class="navLink">Tombstone</a>
            <a href="#" class="navLink">My Account</a>
        <?php else : ?>
            <a href="<?= $baseURL; ?>/app/register.php" class="navLink">Register</a>
        <?php endif; ?>
    </nav>
    <div class="footerText">
        <?php if (isset($_SESSION['playerID'])) : ?>
            <div class="logoutContainer">
                <form method="post" action="<?= $baseURL; ?>/app/logout.php">
                    <button type="submit" name="logout">Log Out</button>
                </form>
            </div>
        <?php endif; ?>
        <p>Henrik Andersen 2024 - The Proving Grounds</p>
    </div>
</footer>
<!-- update version number when making changes, script can get cached -->
<script src="<?= $baseURL; ?>/styles/script.js?v=2"></script>
</body>

</html>