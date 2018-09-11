<?php

namespace Framework\Controllers;

use Framework\Controllers\Contracts\Middleware;
use Framework\Request\Request;
use Framework\Responses\Response;

class Controller
{
    use HandlesPagination,
        HandlesResponse;

    /**
     * Current request to handle
     *
     * @var Request
     */
    protected $request;

    /**
     * Set of middlewares to apply to a request
     *
     * @var Middleware[]
     */
    protected $middlewares = [];

    /**
     * Handle request using given method
     *
     * @param string $method
     * @param Request $request
     * @return Response
     */
    public function handle($method, $request)
    {
        foreach ($this->middlewares as $middleware) {
            $response = $middleware->handle($request);

            if (!is_null($response)) {
                // Bypass controller and return this as response
                return $response;
            }
        }

        $this->request = $request;

        return $this->$method();
    }

    /**
     * Add a middleware
     *
     * @param Middleware $middleware
     * @return $this
     */
    public function pushMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;

        return $this;
    }
}
