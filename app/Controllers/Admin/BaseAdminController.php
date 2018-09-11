<?php

namespace App\Controllers\Admin;

use App\Middlewares\AdminOnly;
use Framework\Controllers\Controller;

/**
 * Base controller which allows actions only to admins
 *
 * @package App\Controllers\Admin
 */
abstract class BaseAdminController extends Controller
{
    /**
     * BaseAdminController constructor.
     */
    public function __construct()
    {
        $this->pushMiddleware(new AdminOnly());
    }
}
