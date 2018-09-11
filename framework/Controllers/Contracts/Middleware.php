<?php

namespace Framework\Controllers\Contracts;

use Framework\Request\Request;

/**
 * Interface Middleware
 *
 * @package Framework\Controllers
 */
interface Middleware
{
    /**
     * Handle given request
     *
     * @param \Framework\Request\Request $request
     * @return mixed
     */
    public function handle($request);
}
