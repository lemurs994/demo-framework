<?php require_once APPROOT . "Views/inc/outer/header.php" ?>
<?php header('HTTP/1.0 404 Not Found', true, 404); ?>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">ERROR 404</h1>
      <p class="lead">PAGE NOT FOUND.</p>
      <p class="lead">
          <a href="<?= $_SERVER['HTTP_REFERER'] ?>">Back </a> |
          <a href="/">Home</a>
      </p>
    </div>
  </div>


<?php require_once APPROOT . "Views/inc/outer/footer.php" ?>
