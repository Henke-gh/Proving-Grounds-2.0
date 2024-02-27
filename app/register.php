<?php
require __DIR__ . "/../bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $newUsername = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
    $newPassword = trim(htmlspecialchars($_POST['password'], ENT_QUOTES));
    $newPasswordRepeat = trim(htmlspecialchars($_POST['passwordRepeat'], ENT_QUOTES));
    unset($_POST['username']);
    unset($_POST['password']);
    unset($_POST['passwordRepeat']);
    $usernames = $database->getUsernames();
    if (in_array($newUsername, $usernames)) {
        $_SESSION['error'] = "Sorry, " . $newUsername . " is not available.";
    } elseif ($newPassword !== $newPasswordRepeat) {
        $_SESSION['error'] = "Passwords don't match. Try again.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $database->addUser($newUsername, $hashedPassword);
        $_SESSION['loginFailed'] = "User created! Remember your password :)";
        header('Location:' . $baseURL . '/index.php');
        exit();
    }
}

require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <?php
    if (isset($_SESSION['error'])) : ?>
        <div class="errorMsg">
            <h3><?= $_SESSION['error']; ?></h3>
        </div>
    <?php
        unset($_SESSION['error']);
    endif; ?>
    <div class="loginContainer register">
        <form method="post" action="">
            <h4>Register new user</h4>
            <p>No email required. Pick a nice username.</p>
            <div class="loginForm">
                <div class="loginItem">
                    <label for="username">Username:</label>
                    <input type="text" required id="username" name="username">
                </div>
                <div class="loginItem">
                    <label for="password">Password:</label>
                    <input type="password" required id="password" name="password">
                </div>
                <div class="loginItem">
                    <label for="passwordRepeat">Repeat Password:</label>
                    <input type="password" required id="passwordRepeat" name="passwordRepeat">
                </div>
                <p>Take care to remember your password!</p>
                <button type="submit" name="register">Register</button>
            </div>
        </form>
        <img src="<?= $baseURL; ?>/assets/images/crossing_swords.png">
    </div>
</main>
<?php
require_once __DIR__ . "/../nav/footer.php";
