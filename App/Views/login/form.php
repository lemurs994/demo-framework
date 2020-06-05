<?php require_once APPROOT . 'Views/inc/outer/header.php'?>
<form action="/login" method="POST">
    <?php
    var_dump($post);
    ?>
<div class="card-body m-5 bg-light rounded">
    <div class="row mx-auto my-5">
        <div class="col-12 mb-5">
            <h1 class="card-title text-center h1">LOGIN</h1>
        </div>
        <div class="row col-4 mx-auto mb-5">
            <div class="col-12 mb-2">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control card-text <?= \App\Helpers\Output::IsInvalid($errors, 'email_error') ?>"
                        value="<?= \App\Helpers\Output::Isset($post, 'email') ?>">
                    <span class="invalid-feedback"><?= \App\Helpers\Output::Isset($errors, 'email_error') ?></span>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control card-text <?= \App\Helpers\Output::IsInvalid($errors, 'password_error') ?>"
                        value="<?= \App\Helpers\Output::Isset($post, 'password') ?>">
                    <span class="invalid-feedback"><?= \App\Helpers\Output::Isset($errors, 'password_error') ?></span>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="form-group">
                    <input type="submit" class="btn btn-secondary btn-block" class="form-control card-text">
                </div>
            </div>
        </div>
    </div>
</div>

</form>
<?php require_once APPROOT . 'Views/inc/outer/footer.php'?>



