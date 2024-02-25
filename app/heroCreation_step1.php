<?php
//_step1 of character creation handles naming of the player hero, gender selection and avatar choice.
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../functions/avatarArray.php";
require __DIR__ . "/../nav/header.php";
?>

<main>
    <h2>Character Creation</h2>
    <div class="characterCreation">
        <form class="characterCreate" method="post" action="<?= $baseURL; ?>/app/heroCreation_step2.php">
            <label for="heroName">Name your hero:</label>
            <input class="heroNameInput" id="heroName" type="text" required name="heroName">
            <label for="heroGender">Select gender:</label>
            <select id="heroGender" name="heroGender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <label>Choose avatar:</label>
            <div class="avatarSelect">
                <input type="hidden" value="" id="selectedAvatar" name="heroAvatar" required>
                <?php
                $avatarIndex = 0;
                foreach ($avatars as $avatar) : ?>
                    <div class="avatar">
                        <img class="avatarImage" data-avatar-id="<?= $avatarIndex; ?>" src="<?= $avatar['url']; ?>">
                    </div>
                <?php
                    $avatarIndex++;
                endforeach; ?>
            </div>
            <button type="submit" name="createHero">Create</button>
        </form>
    </div>
</main>
<script src="<?= $baseURL; ?>/styles/avatarSelection.js"></script>

<?php
require __DIR__ . "/../nav/footer.php";
