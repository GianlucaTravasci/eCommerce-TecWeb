<?php

namespace Framework\Request;

use Framework\Request\Contracts\Session;

/**
 * BaseSession
 *
 * @package Framework\Request
 */
abstract class BaseSession implements Session
{
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
        return $this->get($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @inheritdoc
     */
    public function pop($key, $default = null)
    {
        $item = $this->get($key, $default);

        $this->remove($key);

        return $item;
    }
}
