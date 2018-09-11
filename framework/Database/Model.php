<?php

namespace Framework\Database;

use PDO;

class Model
{
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Proxy static calls to new builder object
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new Builder(static::class))->$name(...$arguments);
    }

    /**
     * Build new model instance
     *
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Proxy property get to attributes
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Proxy property set to attributes
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Find model by id
     *
     * @param int $id
     * @return static
     */
    public static function find($id)
    {
        return static::where('id', $id)->get();
    }

    /**
     * Mass assign attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * Save changes
     *
     * @return $this
     */
    public function save()
    {
        if ($this->exists) {
            return $this->update();
        }

        return $this->insert();
    }

    /**
     * Update model in database
     *
     * @return $this
     */
    protected function update()
    {
        $sql = $this->buildUpdateSql();

        $stmt = Database::getConnection()->prepare($sql);

        foreach ($this->attributes as $key => $value) {
            $stmt->bindValue(
                ":" . $key,
                $value,
                is_bool($value) ? PDO::PARAM_BOOL : PDO::PARAM_STR
            );
        }

        $stmt->execute();

        return $this;
    }

    /**
     * Build update SQL query
     *
     * @return string
     */
    protected function buildUpdateSql()
    {
        $sql = "UPDATE `" . static::$table . "` SET ";

        $sets = array_map(function ($key) {
            return "`" . $key . "` = :" . $key;
        }, array_keys($this->attributes));

        $sql .= implode(", ", $sets);

        $sql .= " WHERE `id` = :id";

        return $sql;
    }

    /**
     * Insert new model in database
     *
     * @return $this
     */
    protected function insert()
    {
        $sql = $this->buildInsertSql();

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare($sql);

        foreach ($this->attributes as $key => $value) {
            $stmt->bindValue(
                ":" . $key,
                $value,
                is_bool($value) ? PDO::PARAM_BOOL : PDO::PARAM_STR
            );
        }

        $stmt->execute();

        $this->id = $pdo->lastInsertId();

        return $this;
    }

    /**
     * Build insert SQL query
     *
     * @return string
     */
    protected function buildInsertSql()
    {
        $sql = "INSERT INTO `" . static::$table . "`";

        $columns = array_map(function ($column) {
            return "`" . $column . "`";
        }, array_keys($this->attributes));
        $sql .= " (" . implode(",", $columns) . ")";

        $values = array_map(function ($column) {
            return ":" . $column;
        }, array_keys($this->attributes));
        $sql .= " VALUES (" . implode(",", $values) . ")";

        return $sql;
    }

    /**
     * Delete model from database
     *
     * @return $this
     */
    public function destroy()
    {
        $sql = $this->buildDestroySql();

        $stmt = Database::getConnection()->prepare($sql);

        $stmt->bindValue(":id", $this->id);

        $stmt->execute();

        $this->exists = false;

        return $this;
    }

    /**
     * Build delete SQL query
     *
     * @return string
     */
    protected function buildDestroySql()
    {
        return "DELETE FROM `" . static::$table . "` WHERE `id` = :id";
    }
}
