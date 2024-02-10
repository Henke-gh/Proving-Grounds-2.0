<?php
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <div>
        <p>Read text about things here.</p>
        <p>Login form, latest updates and image</p>
    </div>
    <form method="post" action="/app/heroCreation_step1.php">
        <button type="submit" name="createNew">Create New Hero</button>
    </form>
    <div>
        <a href="/app/playerHero.php">RESUME</a>
    </div>
</main>
<?php
require __DIR__ . "/nav/footer.html";
