<?php

namespace App\Middlewares;

use Framework\Auth\Guard;
use Framework\Controllers\BaseMiddleware;

/**
 * Filter requests to be accessible to only admins
 *
 * @package App\Middlewares
 */
class UserOnly extends BaseMiddleware
{
    /**
     * @inheritdoc
     */
    public function handle($request)
    {
        if (!Guard::check()) {
            return $this->redirect('/login');
        }

        return null;
    }
}
