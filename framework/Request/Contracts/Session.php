<?php

namespace Framework\Request\Contracts;

/**
 * Abstraction around session storage
 *
 * @package Framework\Request\Contracts
 */
interface Session extends \ArrayAccess
{
    /**
     * Get element from session
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Determine if element is in session
     *
     * @param string $key
     * @return boolean
     */
    public function has($key);

    /**
     * Set element into session
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set($key, $value);

    /**
     * Remove element from session
     *
     * @param string $key
     * @return $this
     */
    public function remove($key);

    /**
     * Pop element from session (get and remove)
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function pop($key, $default = null);
}
