<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title . ' - ' : '' ?><?= trans('layout.title') ?></title>
    <meta name="description" content="<?= trans('layout.description') ?>">
    <meta name="keywords" content="<?= trans('layout.keywords') ?>">
    <meta property="og:title" content="<?= trans('layout.title') ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="E-Commerce">
    <meta property="og:image" content="<?= asset('/images/logo.png') ?>">
    <meta property="og:description" content="<?= trans('layout.description') ?>">
    <link rel="shortcut icon" href="<?= asset('/images/favicon.png') ?>" type="favicon/ico">

    <link href="<?= mix('/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>
<body>

<div class="sr-only">
    <a href="#content"><?= trans('layout.go_to_content') ?></a>
</div>

<header class="header">
    <div class="container">
        <div class="logo-container">
            <a href="<?= route('/') ?>">
                <img src="<?= asset('/images/logo.png') ?>"
                     class="logo logo-extended img-fluid"
                     alt="<?= trans('layout.title') ?>">
                <img src="<?= asset('/images/logo_square.png') ?>"
                     class="logo logo-square img-fluid"
                     alt="<?= trans('layout.title') ?>">
            </a>
        </div>

        <div class="search">
            <form action="<?= route('/products') ?>" method="get">
                <?php if (!env('PRETTY_LINKS', false)) { ?>
                    <input type="hidden" name="r" value="/products">
                <?php } ?>
                <?php if (!empty($category)) { ?>
                    <input type="hidden" name="category_id" value="<?= $category->id ?>">
                <?php } ?>
                <?php if (request('order')) { ?>
                    <input type="hidden" name="order" value="<?= request('order') ?>">
                <?php } ?>

                <input type="text"
                       class="search-input"
                       name="q"
                       placeholder="<?= trans('products.search_query') ?>"
                       aria-label="<?= trans('products.search_query') ?>"
                       value="<?= e(request('q', '')) ?>">
            </form>
        </div>

        <div class="line-break"></div>

        <?php if ($cart->empty()) { ?>
            <div class="menu enhancable<?= request()->route() == '/products' ? ' active' : '' ?>">
                <a href="<?= route('/products') ?>" class="heading enchance-target">
                    <?= trans('layout.discover') ?>
                </a>
            </div>
        <?php } else { ?>
            <div class="menu enhancable<?= request()->route() == '/cart' ? ' active' : '' ?>">
                <a href="<?= route('/cart') ?>" class="heading enchance-target">
                    <?= trans('layout.cart', ['items' => $cart->count()]) ?>
                </a>
            </div>
        <?php } ?>

        <?php if (is_null($user)) { ?>
            <div class="menu enhancable<?= in_array(request()->route(), ['/login', '/register']) ? ' active' : '' ?>">
                <a href="<?= route('/login') ?>" class="heading enchance-target">
                    <?= trans('auth.login') ?>
                </a>
            </div>
        <?php } else { ?>
            <div class="menu enhancable<?= request()->route() == '/orders' ? ' active' : '' ?>">
                <a href="<?= route('/orders') ?>" class="heading enchance-target">
                    <?= $user->fullName(); ?>
                </a>
            </div>

            <div class="menu enhancable">
                <a href="<?= route('/logout') ?>" class="heading enchance-target">
                    <?= trans('auth.logout') ?>
                </a>
            </div>
        <?php } ?>
    </div>
</header>
