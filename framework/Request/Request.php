<?php

namespace Framework\Request;

/**
 * Request Object
 *
 * @package Framework\Controllers
 */
class Request implements \ArrayAccess
{
    /**
     * HTTP GET
     *
     * @var array
     */
    protected $get;

    /**
     * HTTP POST
     *
     * @var array
     */
    protected $post;

    /**
     * Flash data to show to user
     *
     * @var array
     */
    protected $flash;

    /**
     * Request Route
     *
     * @var string
     */
    protected $route;

    /**
     * HTTP method
     *
     * @var string
     */
    protected $method;

    /**
     * HTTP Files
     *
     * @var array
     */
    protected $files;

    /**
     * Build a new request
     *
     * @param array $get
     * @param array $post
     * @param array $flash
     * @param string $route
     * @param string $method
     * @param array $files
     */
    public function __construct($get, $post, $flash = [], $route = '/', $method = 'GET', $files = [])
    {
        $this->get = $get;
        $this->post = $post;
        $this->flash = $flash;
        $this->route = $route;
        $this->method = $method;
        $this->files = $files;
    }

    /**
     * Build a request object from current HTTP request
     *
     * @return static
     */
    public static function current()
    {
        return new static(
            trim_all($_GET),
            trim_all($_POST),
            json_decode(session()->pop('flash', '{}'), true),
            env('PRETTY_LINKS', false) ? $_SERVER['REQUEST_URI'] : $_GET['r'] ?? '/',
            isset($_POST['http_method']) ? $_POST['http_method'] : $_SERVER['REQUEST_METHOD'],
            $_FILES
        );
    }

    /**
     * Request route
     *
     * @return string
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * HTTP Method
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Fetch all input
     *
     * @return array
     */
    public function all()
    {
        return array_merge($this->get, $this->post);
    }

    /**
     * Fetch get param
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }

        return $default;
    }

    /**
     * Fetch post param
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function post($key, $default = null)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }

        return $default;
    }

    /**
     * Fetch get or post param
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function input($key, $default = null)
    {
        if (!is_null($get = $this->get($key))) {
            return $get;
        }

        return $this->post($key, $default);
    }

    /**
     * Determine if request has given input
     *
     * @param string $key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $this->get) || array_key_exists($key, $this->post);
    }

    /**
     * Fetch flash message
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function flash($key, $default = null)
    {
        if (isset($this->flash[$key])) {
            return $this->flash[$key];
        }

        return $default;
    }

    /**
     * Determine if request has given file
     *
     * @param string $key
     * @return boolean
     */
    public function hasFile($key)
    {
        return isset($this->files[$key]) && $this->files[$key]['size'] > 0;
    }

    /**
     * Fetch file param
     *
     * @param string $key
     * @return array
     */
    public function file($key)
    {
        return $this->files[$key];
    }

    /**
     * Fetch file mimeType
     *
     * @param string $key
     * @return null|string
     */
    public function mimeType($key)
    {
        if ($this->hasFile($key)) {
            return mime_content_type($this->file($key)['tmp_name']);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->input($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException("Cannot mutate request object.");
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        throw new \RuntimeException("Cannot mutate request object.");
    }
}
