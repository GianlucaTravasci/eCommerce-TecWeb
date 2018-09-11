<?php

namespace Framework\Controllers;

use Framework\Controllers\Contracts\Middleware;

/**
 * Base Middleware
 *
 * @package Framework\Controllers
 */
abstract class BaseMiddleware implements Middleware
{
    use HandlesResponse;
}
