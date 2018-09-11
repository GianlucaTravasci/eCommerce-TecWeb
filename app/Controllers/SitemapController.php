<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use Framework\Controllers\Controller;
use Framework\Responses\Response;

/**
 * Sitemap Controller
 *
 * @package App\controllers
 */
class SitemapController extends Controller
{
    /**
     * Display homepage
     *
     * @return Response
     */
    public function index()
    {
        $host = env('HOST', 'http://locahost');
        $subdirectory = env('SUBDIRECTORY', '/');

        $categories = Category::orderBy('name', SORT_ASC)->all();
        $products = Product::orderBy('name', SORT_ASC)->all();

        header('Content-Type: application/xml');

        return $this->view('sitemap.index', compact('host', 'subdirectory', 'products', 'categories'));
    }
}
