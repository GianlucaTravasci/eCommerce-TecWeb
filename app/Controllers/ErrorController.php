<?php

namespace App\Controllers;

use Framework\Controllers\Controller;

/**
 * General error controller
 *
 * @package App\controllers
 */
class ErrorController extends Controller
{
    /**
     * Return 404 error page
     *
     * @return string
     */
    public function notFound()
    {
        return $this->view('error.404', [], 404);
    }
}
