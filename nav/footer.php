<footer>
    <?php if (isset($_SESSION['playerID'])) : ?>
        <form method="post" action="/../app/logout.php">
            <button type="submit" name="logout">Log Out</button>
        </form>
        <form method="post" action="/../functions/delete.php">
            <button type="submit" name="deleteHero">Delete Hero</button>
        </form>
    <?php endif; ?>
</footer>
</body>

</html>