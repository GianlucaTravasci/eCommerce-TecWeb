<?php

namespace Framework\Database;

/**
 * Model builder
 *
 * @package Framework\Database
 *
 * @mixin Query
 */
class Builder
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var Query
     */
    protected $query;

    /**
     * Create by setting model class
     *
     * @param string $model
     */
    public function __construct($model)
    {
        $this->model = $model;
        $this->query = (new Query())->table($model::$table);
    }

    /**
     * Proxy calls to query object
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $result = $this->query->$name(...$arguments);

        if ($result instanceof Query) {
            return $this;
        }

        return $result;
    }

    /**
     * Fetch first result
     *
     * return array|Model[]
     */
    public function all()
    {
        $results = $this->query->get();

        return array_map(function ($row) {
            return $this->hydrate($row);
        }, $results);
    }

    /**
     * Fetch first result
     *
     * return mixed|Model
     */
    public function get()
    {
        $results = $this->query->get();

        if (empty($results)) {
            return null;
        }

        return $this->hydrate($results[0]);
    }

    /**
     * Convert attributes to model class
     *
     * @param array $attributes
     * @return mixed|Model
     */
    protected function hydrate($attributes)
    {
        $class = $this->model;

        $model = new $class($attributes);

        $model->exists = true;

        return $model;
    }
}
