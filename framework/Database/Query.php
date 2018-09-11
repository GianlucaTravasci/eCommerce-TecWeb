<?php

namespace Framework\Database;

use PDO;

class Query
{
    /**
     * @var null|string
     */
    protected $table = null;

    /**
     * @var string
     */
    protected $select = '*';

    /**
     * @var array
     */
    protected $where = [];

    /**
     * @var null|array
     */
    protected $orderBy = null;

    /**
     * @var null|int
     */
    protected $limit = null;

    /**
     * @var null|int
     */
    protected $offset = null;

    /**
     * @var array
     */
    protected $bindings = [];

    /**
     * Set table
     *
     * @param string $name
     * @return $this
     */
    public function table($name)
    {
        $this->table = $name;

        return $this;
    }

    /**
     * Set select field
     *
     * @param string $select
     * @return $this
     */
    public function select($select)
    {
        $this->select = $select;

        return $this;
    }

    /**
     * Add condition to query
     *
     * @param string|array $name
     * @param null|string $operand
     * @param null|mixed $value
     * @return $this
     */
    public function where($name, $operand = null, $value = null)
    {
        if (func_num_args() == 2) {
            $value = $operand;
            $operand = '=';
        }

        if (func_num_args() > 1) {
            return $this->rawWhere(
                $this->buildCondition($name, $operand, $value)
            );
        }

        if (is_array($name)) {
            foreach ($name as $row) {
                $this->where(...$row);
            }
        }

        return $this;
    }

    /**
     * Add condition to query
     *
     * @param string|array $name
     * @param array $values
     * @return $this
     */
    public function whereIn($name, $values)
    {
        if (is_array($name)) {
            foreach ($name as $row) {
                $this->whereIn(...$row);
            }
        }

        $sql = "`${name}` IN (";

        foreach ($values as $value) {
            $bindingIdentifier = $this->pushBinding($value);

            $sql .= ":{$bindingIdentifier},";
        }

        $sql = substr($sql, 0, -1) . ")";

        return $this->rawWhere($sql);
    }

    /**
     * @param $condition
     * @return $this
     */
    public function rawWhere($condition)
    {
        $this->where[] = $condition;

        return $this;
    }

    /**
     * Build condition
     *
     * @param string $name
     * @param string $operand
     * @param string $value
     * @return string
     */
    protected function buildCondition($name, $operand, $value)
    {
        if (is_null($value) && $operand = '=') {
            return "`${name}` IS NULL";
        }

        $bindingIdentifier = $this->pushBinding($value);

        return "`${name}` ${operand} :${bindingIdentifier}";
    }

    /**
     * Push PDO binding into query
     *
     * @param string $value
     * @param null|string $key
     * @return string
     */
    public function pushBinding($value, $key = null)
    {
        $bindingIdentifier = is_null($key) ? uniqid() : $key;

        $this->bindings[$bindingIdentifier] = $value;

        return $bindingIdentifier;
    }

    /**
     * Set orderBy condition
     *
     * @param string $column
     * @param int $sort
     * @return $this
     */
    public function orderBy($column, $sort = SORT_ASC)
    {
        $this->orderBy = [$column, $sort];

        return $this;
    }

    /**
     * Set limit condition
     *
     * @param string $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Set offset condition
     *
     * @param string $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Get query results
     *
     * @return array
     */
    public function get()
    {
        $stmt = $this->buildStatement();

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Count query results
     *
     * @return int
     */
    public function count()
    {
        return $this->select('COUNT(*)')->column();
    }

    /**
     * Fetch first column of first result
     *
     * @return string
     */
    public function column()
    {
        $stmt = $this->buildStatement();

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_NUM)[0][0];
    }

    /**
     * Build PDO statement
     *
     * @return \PDOStatement
     */
    protected function buildStatement()
    {
        $stmt = Database::getConnection()->prepare($this->buildSql());

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        return $stmt;
    }

    /**
     * Build SQL query
     *
     * @return string
     */
    protected function buildSql()
    {
        if (!str_contains($this->table, '`')) {
            $this->table = "`{$this->table}`";
        }

        $sql = "SELECT {$this->select} FROM {$this->table}";

        if (!empty($this->where)) {
            $sql .= " WHERE ";

            $where = array_map(function ($row) {
                return "(" . $row . ")";
            }, $this->where);

            $sql .= implode(" AND ", $where);
        }

        if (!is_null($this->orderBy)) {
            $sql .= " ORDER BY `" . $this->orderBy[0] . "` " . ($this->orderBy[1] == SORT_ASC ? 'ASC' : 'DESC');
        }

        if (!is_null($this->limit)) {
            $sql .= " LIMIT " . $this->limit;

            if (!is_null($this->offset)) {
                $sql .= " OFFSET " . $this->offset;
            }
        }

        return $sql;
    }
}
