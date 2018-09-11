<?= $this->view('layout.header', ['title' => 'Login']) ?>

<div id="content" class="container page login-page">

    <div class="login-form">
        <form action="<?= route('/login') ?>" method="post">
            <h1><?= trans('auth.login') ?></h1>

            <?= $this->view('components.alert') ?>

            <div class="login-helper">
                <?= trans('auth.no_account') ?>
                <a href="<?= route('/register') ?>">
                    <?= trans('auth.register_one') ?>
                </a>
            </div>

            <div class="login-group">
                <label for="login_email" class="sr-only"><?= trans('auth.email_or_username') ?></label>
                <input type="text"
                       class="login-input"
                       id="login_email"
                       name="email"
                       placeholder="<?= trans('auth.email_or_username') ?>"
                       value="<?= e(old('email')) ?>"
                       required>
            </div>

            <div class="login-group">
                <label for="login_password" class="sr-only"><?= trans('auth.password') ?></label>
                <input type="password"
                       class="login-input"
                       id="login_password"
                       name="password"
                       placeholder="<?= trans('auth.password') ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-block btn-primary">
                <?= trans('auth.login_submit') ?>
            </button>
        </form>
    </div>

</div>

<?= $this->view('layout.footer') ?>
