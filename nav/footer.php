<footer>
    <nav class="footerNav">
        <?php if (isset($_SESSION['playerID'])) : ?>
            <a href="/../app/playerHero.php" class="navLink">Hero</a>
        <?php else : ?>
            <a href="/../index.php" class="navLink">Start</a>
        <?php endif; ?>
        <a href="#" class="navLink">About</a>
        <a href="/../app/gameguide.php" class="navLink">Game Guide</a>
        <?php if (isset($_SESSION['playerID'])) : ?>
            <a href="/../app/tombstone.php" class="navLink">Tombstone</a>
            <a href="#" class="navLink">My Account</a>
        <?php else : ?>
            <a href="/../app/register.php" class="navLink">Register</a>
        <?php endif; ?>
    </nav>
    <div class="footerText">
        <?php if (isset($_SESSION['playerID'])) : ?>
            <div class="logoutContainer">
                <form method="post" action="/../app/logout.php">
                    <button type="submit" name="logout">Log Out</button>
                </form>
                <form method="post" action="/../functions/delete.php">
                    <button type="submit" name="deleteHero">Delete Hero</button>
                </form>
            </div>
        <?php endif; ?>
        <p>Henrik Andersen 2024 - The Proving Grounds</p>
    </div>
</footer>
<script src="/../styles/script.js"></script>
</body>

</html>