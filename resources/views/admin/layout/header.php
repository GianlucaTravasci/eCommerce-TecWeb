<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Admin - <?= trans('layout.title') ?></title>
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
            <a href="<?= route('/admin') ?>">
                <img src="<?= asset('/images/logo.png') ?>"
                     class="logo img-fluid"
                     alt="<?= trans('layout.title') ?>">
            </a>
        </div>

        <div class="spacer"></div>

        <div class="line-break"></div>

        <div class="menu enhancable">
            <a href="<?= route('/') ?>" class="heading enchance-target">
                <?= trans('dashboard.back_to_site') ?>
            </a>
        </div>

        <div class="menu enhancable<?= request()->route() == '/admin' ? ' active' : '' ?>">
            <a href="<?= route('/admin') ?>" class="heading enchance-target">
                <?= trans('dashboard.title') ?>
            </a>
        </div>

        <div class="menu enhancable<?= starts_with(request()->route(), ['/admin/categories', '/admin/category']) ? ' active' : '' ?>">
            <a href="<?= route('/admin/categories') ?>" class="heading enchance-target">
                <?= trans('categories.title') ?>
            </a>
        </div>

        <div class="menu enhancable<?= starts_with(request()->route(), '/admin/product') ? ' active' : '' ?>">
            <a href="<?= route('/admin/products') ?>" class="heading enchance-target">
                <?= trans('products.title') ?>
            </a>
        </div>

        <div class="menu enhancable<?= starts_with(request()->route(), '/admin/order') ? ' active' : '' ?>">
            <a href="<?= route('/admin/orders') ?>" class="heading enchance-target">
                <?= trans('orders.title') ?>
            </a>
        </div>
    </div>
</header>
