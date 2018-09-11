<?= $this->view('layout.header', ['title' => trans('auth.register')]) ?>

<div id="content" class="container page register-page">

    <form action="<?= route('/register') ?>" method="post">
        <div class="register-form">
            <h1 class="register-title"><?= trans('auth.register') ?></h1>

            <?= $this->view('components.alert') ?>

            <div class="register-group">
                <div class="register-group-title">
                    <h2><?= trans('auth.login_data') ?></h2>
                </div>

                <div class="register-group-body">

                    <div class="register-field">
                        <label for="username" class="sr-only"><?= trans('auth.username') ?></label>
                        <input type="text"
                               class="register-input"
                               id="username"
                               placeholder="<?= trans('auth.username') ?>"
                               name="username"
                               value="<?= e(old('username')) ?>"
                               required>
                    </div>

                    <div class="register-field">
                        <label for="email" class="sr-only"><?= trans('auth.email') ?></label>
                        <input type="email"
                               class="register-input"
                               id="email"
                               placeholder="<?= trans('auth.email') ?>"
                               name="email"
                               value="<?= e(old('email')) ?>"
                               required>
                    </div>

                    <div class="register-field">
                        <label for="password" class="sr-only"><?= trans('auth.password') ?></label>
                        <input type="password"
                               class="register-input"
                               id="password"
                               placeholder="<?= trans('auth.password') ?>"
                               name="password"
                               required>
                    </div>

                    <div class="register-field">
                        <label for="password_confirmation"
                               class="sr-only"><?= trans('auth.password_confirmation') ?></label>
                        <input type="password"
                               class="register-input"
                               id="password_confirmation"
                               placeholder="<?= trans('auth.password_confirmation') ?>"
                               name="password_confirmation"
                               required>
                    </div>
                </div>
            </div>


            <div class="register-group">
                <div class="register-group-title">
                    <h2><?= trans('auth.your_data') ?></h2>
                </div>

                <div class="register-group-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="sr-only"><?= trans('auth.first_name') ?></label>
                            <input type="text"
                                   class="register-input"
                                   id="name"
                                   placeholder="<?= trans('auth.first_name') ?>"
                                   name="name"
                                   value="<?= e(old('name')) ?>"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="surname" class="sr-only"><?= trans('auth.last_name') ?></label>
                            <input type="text"
                                   class="register-input"
                                   id="surname"
                                   placeholder="<?= trans('auth.last_name') ?>"
                                   name="surname"
                                   value="<?= e(old('surname')) ?>"
                                   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="country" class="sr-only"><?= trans('auth.country') ?></label>
                            <select class="register-input" id="country" name="country" required>
                                <?php foreach ($countries as $country) { ?>
                                    <option value="<?= $country ?>""<?= old('country') == $country ? ' selected' : '' ?>">
                                    <?= trans('countries.' . $country) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="city" class="sr-only"><?= trans('auth.city') ?></label>
                            <input type="text"
                                   class="register-input"
                                   id="city"
                                   placeholder="<?= trans('auth.city') ?>"
                                   name="city"
                                   value="<?= e(old('city')) ?>"
                                   required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="street" class="sr-only"><?= trans('auth.street') ?></label>
                            <input type="text"
                                   class="register-input"
                                   id="street"
                                   placeholder="<?= trans('auth.street') ?>"
                                   name="street"
                                   value="<?= e(old('street')) ?>"
                                   required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="number" class="sr-only"><?= trans('auth.number') ?></label>
                            <input type="text"
                                   class="register-input"
                                   id="number"
                                   placeholder="<?= trans('auth.number') ?>"
                                   name="number"
                                   value="<?= e(old('number')) ?>"
                                   required>
                        </div>
                    </div>
                </div>

            </div>

            <div class="register-confirm">
                <button type="submit" class="btn btn-primary"><?= trans('auth.register_submit') ?></button>
            </div>

        </div>
    </form>
</div>

<?= $this->view('layout.footer') ?>
