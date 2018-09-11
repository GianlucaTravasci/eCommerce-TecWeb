<?php

namespace App\Controllers;

use App\Queries\ProductQuery;
use Framework\Controllers\Controller;
use Framework\Responses\Response;

/**
 * Homepage controller
 *
 * @package App\controllers
 */
class HomeController extends Controller
{
    /**
     * Display homepage
     *
     * @return Response
     */
    public function index()
    {
        $products = ProductQuery::homepage();

        return $this->view('homepage.index', compact('products'));
    }
}
