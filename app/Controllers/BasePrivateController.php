<?php

namespace App\Controllers;

use App\Middlewares\UserOnly;
use Framework\Controllers\Controller;

/**
 * Base controller which allows actions only to users
 *
 * @package App\Controllers
 */
abstract class BasePrivateController extends Controller
{
    /**
     * BaseAdminController constructor.
     */
    public function __construct()
    {
        $this->pushMiddleware(new UserOnly());
    }
}
