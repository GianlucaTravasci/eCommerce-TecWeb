<?php

namespace Framework\Responses;

class BaseResponse implements Response
{
    use HandlesFlash;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $code;

    /**
     * Build response with content
     *
     * @param string $content
     * @param int $code
     */
    public function __construct($content, $code = 200)
    {
        $this->content = $content;
        $this->code = $code;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        http_response_code($this->code);

        $this->flushFlash();

        echo $this->content;
    }
}
