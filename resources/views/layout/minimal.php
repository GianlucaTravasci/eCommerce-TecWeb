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

<header class="minimal-header">
    <div class="container">
        <div class="logo-container">
            <a href="<?= route('/') ?>">
                <img src="<?= asset('/images/logo.png') ?>"
                     class="logo img-fluid"
                     alt="<?= trans('layout.title') ?>">
            </a>
        </div>
    </div>
</header>
