<?php

namespace Framework\Views;

class View
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $data;

    /**
     * Create a view
     *
     * @param string $name
     * @param array $data
     */
    public function __construct($name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * Build view and return content
     *
     * @return string
     */
    public function build()
    {
        $path = $this->path();

        return $this->render($path, $this->data());
    }

    /**
     * Return path from view name
     *
     * @return string
     */
    protected function path()
    {
        return resources_path('views' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $this->name) . '.php');
    }

    /**
     * Return data for given view
     *
     * @return array
     */
    protected function data()
    {
        return array_merge($this->globalData(), $this->data);
    }

    /**
     * Retrieve and cache global data for all views
     *
     * @return array
     */
    protected function globalData()
    {
        static $data;

        if (is_null($data)) {
            $data = require(app_path('view_data.php'));
        }

        return $data;
    }

    /**
     * Render file with given data
     *
     * @param string $__path
     * @param array $__data
     * @return string
     */
    protected function render($__path, $__data)
    {
        ob_start();

        extract($__data, EXTR_SKIP);

        include $__path;

        return ltrim(ob_get_clean());
    }

    /**
     * Build another view
     *
     * @param string $name
     * @param array $data
     * @return string
     */
    protected function view($name, $data = [])
    {
        return (new View($name, $data))->build();
    }
}
