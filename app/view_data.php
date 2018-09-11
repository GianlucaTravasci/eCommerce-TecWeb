<?php

/**
 * Return a set of variables available into all views
 */
return [
    'user' => \Framework\Auth\Guard::user(),
    'lang' => \Framework\Localization\Translator::language(),
    'countries' => require(app_path('Data/countries.php')),
    'layoutCategories' => \App\Queries\CategoryQuery::grouped(),
    'cart' => \App\Models\Cart::instance(),
];
