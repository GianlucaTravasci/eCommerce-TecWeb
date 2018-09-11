<?php

namespace Framework\Responses;

class RedirectResponse implements Response
{
    use HandlesFlash;

    /**
     * @var string
     */
    protected $to;

    /**
     * Build redirect response
     *
     * @param string $to
     */
    public function __construct($to)
    {
        $this->to = $to;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $this->flushFlash();
        
        header('Location: ' . route($this->to));
    }
}
