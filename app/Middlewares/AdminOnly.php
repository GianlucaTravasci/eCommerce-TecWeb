<?php

namespace App\Middlewares;

use Framework\Auth\Guard;
use Framework\Controllers\BaseMiddleware;

/**
 * Filter requests to be accessible to only admins
 *
 * @package App\Middlewares
 */
class AdminOnly extends BaseMiddleware
{
    /**
     * @inheritdoc
     */
    public function handle($request)
    {
        $user = Guard::user();

        if (is_null($user) || !$user->isAdmin()) {
            return $this->view('error.403', [], 403);
        }

        return null;
    }
}
