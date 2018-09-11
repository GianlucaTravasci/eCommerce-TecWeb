<div class="footer">
    <div class="container">
        <div class="footer-block">
            <h4 class="heading"><?= trans('layout.info') ?></h4>
            <ul class="footer-links">
                <li>
                    <a href="<?= route('/info') ?>"><?= trans('layout.company') ?></a>
                </li>
                <li>
                    <a href="<?= route('/sending') ?>"><?= trans('layout.shipping') ?></a>
                </li>
                <li>
                    <a href="<?= route('/how-to-buy') ?>"><?= trans('layout.how_to_buy') ?></a>
                </li>
                <li>
                    <a href="<?= route('/privacy') ?>"><?= trans('layout.privacy') ?></a>
                </li>
                <li>
                    <a href="<?= route('/faq') ?>"><?= trans('layout.faq') ?></a>
                </li>
                <li>
            </ul>
        </div>

        <div class="line-break"></div>

        <div class="footer-block">
            <h4 class="heading"><?= trans('layout.client_service') ?></h4>
            <ul class="footer-links">
                <li>
                    <a href="mailto:webmaster@example.com"><?= trans('layout.contacts') ?></a>
                </li>
                <li>
                    <a href="<?= route('sitemap.xml') ?>"><?= trans('layout.map') ?></a>
                </li>
            </ul>
            <?php if ($user && $user->isAdmin()) { ?>
                <h4 class="heading"><?= trans('layout.admin') ?></h4>
                <ul class="footer-links">
                    <li>
                        <a href="<?= route('/admin') ?>"><?= trans('layout.control_panel') ?></a>
                    </li>
                </ul>
            <?php } ?>
        </div>

        <div class="line-break"></div>

        <div class="footer-block">
            <h4 class="heading"><?= trans('layout.user_account') ?></h4>
            <ul class="footer-links">
                <li>
                    <a href="<?= route(is_null($user) ? '/login' : '/orders') ?>">
                        <?= trans('layout.user_account') ?>
                    </a>
                </li>
            </ul>
            <h4 class="heading"><?= trans('layout.select_language') ?></h4>
            <ul class="footer-links">
                <li>
                    <a href="<?= route('/language?lang=en') ?>">English</a>
                </li>
                <li>
                    <a href="<?= route('/language?lang=it') ?>">Italiano</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="<?= mix('/js/script.js') ?>"></script>
</body>
</html>
