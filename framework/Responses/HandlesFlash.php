<?php

namespace Framework\Responses;

/**
 * Handles flash messages
 *
 * @package Framework\Responses
 *
 * @mixin Response
 */
trait HandlesFlash
{
    /**
     * @var array
     */
    protected $flash = [];

    /**
     * @inheritdoc
     */
    public function withFlash($data)
    {
        $this->flash = array_merge($this->flash, $data);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function withInput()
    {
        return $this->withFlash([
            'old_input' => request()->all(),
        ]);
    }

    /**
     * Set flash messages
     */
    protected function flushFlash()
    {
        session()->set('flash', json_encode($this->flash));
    }
}
