<footer>
    <?php if (isset($_SESSION['playerID'])) : ?>
        <form method="post" action="/../app/logout.php">
            <button type="submit" name="logout">Log Out</button>
        </form>
    <?php endif; ?>
</footer>
</body>

</html>