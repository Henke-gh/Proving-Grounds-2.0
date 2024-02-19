<?php
require __DIR__ . "/vendor/autoload.php";
session_start();
require __DIR__ . "/nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <?php if (isset($_SESSION['loginFailed'])) : ?>
        <p><?= $_SESSION['loginFailed']; ?></p>
    <?php
        unset($_SESSION['loginFailed']);
    endif; ?>
    <h3>Log in</h3>
    <form method="post" action="/app/verifyLogin.php">
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
        <h3>Latest changes</h3>
        <p>Things have happened</p>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.php";
