<?php
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/bootstrap.php";
session_start();
require __DIR__ . "/nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <img src="<?= $baseURL; ?>/assets/images/crossing_swords.png">
    <?php if (isset($_SESSION['loginFailed'])) : ?>
        <p><?= $_SESSION['loginFailed']; ?></p>
    <?php
        unset($_SESSION['loginFailed']);
    endif; ?>
    <h3>Log in</h3>
    <form method="post" action="<?= $baseURL; ?>/app/verifyLogin.php">
        <div class="loginForm">
            <div class="loginItem">
                <label for="username">Username:</label>
                <input type="text" required id="username" name="username">
            </div>
            <div class="loginItem">
                <label for="password">Password:</label>
                <input type="password" required id="password" name="password">
            </div>
            <button type="submit" name="login">Login</button>
        </div>
    </form>
    <div class="newsMessage">
        <h3>News/ Latest changes 24/2-24</h3>
        <p>There's a game guide now, sweet.</p>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.php";
