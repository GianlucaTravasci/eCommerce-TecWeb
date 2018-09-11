<?php

namespace Framework\Database;

use Exception;
use PDO;
use Throwable;

class Database
{
    public static $connection = null;

    /**
     * Get PDO connection
     *
     * @return \PDO
     */
    public static function getConnection()
    {
        if (is_null(self::$connection)) {
            self::$connection = self::connect();
        }

        return self::$connection;
    }

    /**
     * Create PDO connection
     *
     * @return PDO
     */
    protected static function connect()
    {
        $db = new PDO(
            "mysql:host=" . env('DB_HOST', 'localhost') . ";port=" . env('DB_PORT', 3306) . ";dbname=" . env('DB_DATABASE') . ';charset=utf8',
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    /**
     * Run callback code inside a PDO transaction and
     * commit at the end.
     *
     * If an exception is caught, a rollback will be
     * executed.
     *
     * @param $callback
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public static function transaction($callback)
    {
        $pdo = static::getConnection();

        $pdo->beginTransaction();

        try {
            $result = $callback();

            $pdo->commit();

            return $result;
        } catch (Exception $e) {
            $pdo->rollBack();

            throw $e;
        } catch (Throwable $e) {
            $pdo->rollBack();

            throw $e;
        }
    }
}
