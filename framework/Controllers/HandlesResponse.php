<?php

namespace Framework\Controllers;

use Framework\Responses\BaseResponse;
use Framework\Responses\RedirectResponse;
use Framework\Responses\Response;
use Framework\Responses\ViewResponse;

/**
 * Set of helpers to build responses
 *
 * @package Framework\Controllers
 */
trait HandlesResponse
{
    /**
     * Build a redirect response
     *
     * @param string $to
     * @return Response
     */
    protected function redirect($to)
    {
        return new RedirectResponse($to);
    }

    /**
     * Build a basic response
     *
     * @param int $code
     * @param string $content
     * @return Response
     */
    protected function response($code, $content)
    {
        return new BaseResponse($content, $code);
    }

    /**
     * Build a view response
     *
     * @param string $name
     * @param array $data
     * @param int $code
     * @return Response
     */
    protected function view($name, $data = [], $code = 200)
    {
        return new ViewResponse($name, $data, $code);
    }
}
