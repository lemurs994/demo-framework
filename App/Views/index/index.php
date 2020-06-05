<?php require_once APPROOT . "Views/inc/outer/header.php" ?>
<?php header('HTTP/1.0 404 Not Found', true, 404); ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">DEMO PAGE</h1>
        <p class="lead">This is a demo page.</p>
        <p class="lead">
            <a href="/login">Login</a>
        </p>
    </div>
</div>


<?php require_once APPROOT . "Views/inc/outer/footer.php" ?>
