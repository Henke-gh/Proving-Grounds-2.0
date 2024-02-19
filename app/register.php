<?php
require __DIR__ . "/../bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $newUsername = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
    $newPassword = trim(htmlspecialchars($_POST['password']));
    $newPasswordRepeat = trim(htmlspecialchars($_POST['passwordRepeat']));
    unset($_POST['username']);
    unset($_POST['password']);
    unset($_POST['passwordRepeat']);
    $usernames = $database->getUsernames();
    if (in_array($newUsername, $usernames)) {
        echo "Sorry, " . $newUsername . " is not available.";
    } elseif ($newPassword !== $newPasswordRepeat) {
        echo "Passwords don't match. Try again.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $database->addUser($newUsername, $hashedPassword);
    }
}
require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>Welcome to the Proving Grounds</h2>
    <form method="post" action="">
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
            <button type="submit" name="register">Register</button>
        </div>
    </form>
</main>