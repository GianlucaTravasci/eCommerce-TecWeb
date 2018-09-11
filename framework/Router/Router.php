<?php

namespace Framework\Router;

use Framework\Controllers\Controller;
use Framework\Request\Request;
use Framework\Responses\BaseResponse;
use Framework\Responses\RedirectResponse;
use Framework\Responses\Response;
use Framework\Router\Exceptions\MethodNotAllowedException;
use Framework\Router\Exceptions\NotFoundException;

/**
 * Route input to controller
 *
 * @package Framework\Router
 */
class Router
{
    /**
     * Allowed HTTP methods
     */
    const ALLOWED_METHODS = [
        'GET',
        'POST',
        'DELETE',
        'PUT',
        'PATCH',
    ];

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * Load routes from file
     *
     * @param string $path
     * @return $this
     */
    public function loadRoutes($path)
    {
        $routes = require($path);

        $this->routes = array_merge($this->routes, $routes);

        return $this;
    }

    /**
     * Execute given uri+method combination
     *
     * @param Request $request
     */
    public function go($request)
    {
        $block = $this->matchUri(parse_uri($request->route()));

        if (!in_array($request->method(), static::ALLOWED_METHODS) || !array_key_exists($request->method(), $block)) {
            throw new MethodNotAllowedException();
        }

        $this->run($block[$request->method()], $request);
    }

    /**
     * Run given action
     *
     * @param string|array $action
     * @param Request $request
     */
    public function run($action, $request)
    {
        $response = $this->handle($action, $request);

        $response->execute();
    }

    /**
     * Match uri to routes and return methods block
     *
     * @param string $uri
     * @return array
     */
    protected function matchUri($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri];
        }

        throw new NotFoundException();
    }

    /**
     * Handle given action
     *
     * @param string|array $action
     * @param \Framework\Request\Request $request
     * @return mixed
     */
    protected function handle($action, $request)
    {
        if (is_string($action)) {
            return new RedirectResponse($action);
        }

        list($class, $method) = $action;

        /** @var Controller $controller */
        $controller = new $class();

        $response = $controller->handle($method, $request);

        if ($response instanceof Response) {
            return $response;
        }

        return new BaseResponse($response);
    }
}
