<?php
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <form method="post" action="/app/verifyLogin.php">
        <div class="loginForm">
            <div class="loginItem"></div>
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
    <!-- Temp hero create link -->
    <form method="post" action="/app/heroCreation_step1.php">
        <button type="submit" name="createNew">Create New Hero</button>
    </form>
    <div>
        <a href="/app/playerHero.php">RESUME</a>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.html";
