<?php

if (!function_exists('request')) {
    /**
     * Fetch current request object
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|\Framework\Request\Request
     */
    function request($key = null, $default = null)
    {
        global $request;

        if (is_null($key)) {
            return $request;
        }

        return $request->input($key, $default);
    }
}

if (!function_exists('session')) {
    /**
     * Fetch current session object
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|\Framework\Request\Contracts\Session
     */
    function session($key = null, $default = null)
    {
        global $session;

        if (is_null($key)) {
            return $session;
        }

        return $session->get($key, $default);
    }
}
