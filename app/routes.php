<?php

return [
    '/' => [
        'GET' => [\App\Controllers\HomeController::class, 'index'],
    ],

    // Localization
    '/language' => [
        'GET' => [\App\Controllers\LanguageController::class, 'update'],
    ],

    // Auth
    '/login' => [
        'GET' => [\App\Controllers\AuthController::class, 'showLogin'],
        'POST' => [\App\Controllers\AuthController::class, 'login'],
    ],
    '/logout' => [
        'GET' => [\App\Controllers\AuthController::class, 'logout'],
    ],
    '/register' => [
        'GET' => [\App\Controllers\AuthController::class, 'showRegister'],
        'POST' => [\App\Controllers\AuthController::class, 'register'],
    ],

    // Static Pages
    '/info' => [
        'GET' => [\App\Controllers\PagesController::class, 'info'],
    ],
    '/how-to-buy' => [
        'GET' => [\App\Controllers\PagesController::class, 'howToBuy'],
    ],
    '/faq' => [
        'GET' => [\App\Controllers\PagesController::class, 'faq'],
    ],
    '/privacy' => [
        'GET' => [\App\Controllers\PagesController::class, 'privacy'],
    ],
    '/sending' => [
        'GET' => [\App\Controllers\PagesController::class, 'sending'],
    ],

    // Sitemap
    '/sitemap.xml' => [
        'GET' => [\App\Controllers\SitemapController::class, 'index'],
    ],

    // Storage
    '/storage/images' => [
        'GET' => [\App\Controllers\StorageController::class, 'image'],
    ],

    // Product
    '/products' => [
        'GET' => [\App\Controllers\ProductController::class, 'index'],
    ],
    '/product' => [
        'GET' => [\App\Controllers\ProductController::class, 'get'],
    ],

    // Cart
    '/cart' => [
        'GET' => [\App\Controllers\CartController::class, 'get'],
        'POST' => [\App\Controllers\CartController::class, 'push'],
        'DELETE' => [\App\Controllers\CartController::class, 'remove'],
    ],
    '/checkout' => [
        'GET' => [\App\Controllers\CheckoutController::class, 'get'],
        'POST' => [\App\Controllers\CheckoutController::class, 'store'],
    ],

    // Orders
    '/orders' => [
        'GET' => [\App\Controllers\OrderController::class, 'index'],
    ],
    '/order' => [
        'GET' => [\App\Controllers\OrderController::class, 'get'],
        'DELETE' => [\App\Controllers\OrderController::class, 'destroy'],
    ],

    // Admin
    '/admin' => [
        'GET' => [\App\Controllers\Admin\DashboardController::class, 'index'],
    ],
    '/admin/categories' => [
        'GET' => [\App\Controllers\Admin\CategoryController::class, 'index'],
        'POST' => [\App\Controllers\Admin\CategoryController::class, 'store'],
    ],
    '/admin/category' => [
        'GET' => [\App\Controllers\Admin\CategoryController::class, 'get'],
        'POST' => [\App\Controllers\Admin\CategoryController::class, 'update'],
        'DELETE' => [\App\Controllers\Admin\CategoryController::class, 'destroy'],
    ],
    '/admin/products' => [
        'GET' => [\App\Controllers\Admin\ProductController::class, 'index'],
        'POST' => [\App\Controllers\Admin\ProductController::class, 'store'],
    ],
    '/admin/products/create' => [
        'GET' => [\App\Controllers\Admin\ProductController::class, 'create'],
    ],
    '/admin/product/image' => [
        'GET' => [\App\Controllers\Admin\ProductController::class, 'destroyImage'],
    ],
    '/admin/product' => [
        'GET' => [\App\Controllers\Admin\ProductController::class, 'get'],
        'POST' => [\App\Controllers\Admin\ProductController::class, 'update'],
        'DELETE' => [\App\Controllers\Admin\ProductController::class, 'destroy'],
    ],
    '/admin/orders' => [
        'GET' => [\App\Controllers\Admin\OrderController::class, 'index'],
    ],
    '/admin/order' => [
        'GET' => [\App\Controllers\Admin\OrderController::class, 'get'],
        'DELETE' => [\App\Controllers\Admin\OrderController::class, 'destroy'],
    ],
    '/admin/order/ship' => [
        'POST' => [\App\Controllers\Admin\OrderController::class, 'ship'],
    ],
];
