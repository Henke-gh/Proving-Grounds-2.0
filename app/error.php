<?php
require __DIR__ . "/../bootstrap.php";
if (isset($_SESSION['exceptionError'])) {
    $error = $_SESSION['exceptionError'];
} else {
    header('Location:' . $baseURL);
    exit();
}
if (isset($_POST['startpage'])) {
    header('Location:' . $baseURL);
    exit();
}
require __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>An error has occured</h2>

    <section class="errorSection">
        <p>Something went wrong when the goblins tried to access the database.</p>
        <form method="post">
            <button type="submit" name="startpage">Home</button>
        </form>
        <?php if (isset($error)) : ?>
            <div class="exceptionError">
                <p><?= $error; ?></p>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php
require __DIR__ . "/../nav/footer.php";
