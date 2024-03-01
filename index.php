<?php
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/bootstrap.php";
require __DIR__ . "/nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <p class="bold">(Beta version)</p>
    <?php if (isset($_SESSION['loginFailed'])) : ?>
        <p><?= $_SESSION['loginFailed']; ?></p>
    <?php
        unset($_SESSION['loginFailed']);
    endif; ?>
    <div class="loginContainer">
        <img src="<?= $baseURL; ?>/assets/images/crossing_swords.png">
        <form method="post" action="<?= $baseURL; ?>/app/verifyLogin.php">
            <h3>Log in</h3>
            <div class="loginForm">
                <div class="loginItem">
                    <label for="username">Username:</label>
                    <input type="text" required id="username" name="username">
                </div>
                <div class="loginItem">
                    <label for="password">Password:</label>
                    <input type="password" required id="password" name="password">
                </div>
                <div class="loginOrRegister">
                    <button type="submit" name="login">Login</button>
                    <a href="<?= $baseURL; ?>/app/register.php">Register User</a>
                </div>
            </div>
        </form>
    </div>
    <div class="indexInformation">
        <div class="newsMessage">
            <h3>News/ Latest changes 29/2-24</h3>
            <p>Fixed missing Game Guide link from start page</p>
            <p>Heal-bug gone, probably? Sorry everyone!</p>
            <p class="bold">- Older News -</p>
            <p>Made some hidden item bonuses visible.</p>
            <p>Additional small adjustments to the level 1 enemies.</p>
            <p>Added new items and monsters. Small tweak to the Cultist.</p>
            <p>There's a game guide now, sweet.</p>
        </div>
        <div class="about">
            <article>
                <h3>Test your mettle, claim your fame!</h3>
                <p>The Proving Ground lets you create a hero and battle foes in arena combat. Level up and spend skill points to
                    improve your skills or learn new ones.</p>
                <p>On your journey you will equip your hero with new items to further improve your character and prepare for the dangers that lie ahead.</p>
                <p>If you want a head start and crash-course in the game mechanics have a look at the <a href="<?= $baseURL; ?>/app/gameguide.php">Game Guide</a>.</p>
                <p>Create an account and join the fray! <a href="<?= $baseURL; ?>/app/register.php">Register User</a></p>
            </article>
            <img src="<?= $baseURL; ?>/assets/images/scout_sharp.png" />
        </div>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.php";
