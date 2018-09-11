<?php

namespace Framework\Request;

/**
 * Session based on PHP's $_SESSION
 *
 * @package Framework\Request
 */
class PhpSession extends BaseSession
{
    /**
     * PhpSession constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * @inheritdoc
     */
    public function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * @inheritdoc
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }

        return $this;
    }
}
