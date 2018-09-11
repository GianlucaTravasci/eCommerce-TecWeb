<?php

namespace Framework\Responses;

use Framework\Views\View;

class ViewResponse extends BaseResponse
{
    /**
     * @var View
     */
    protected $view;

    /**
     * Build view response
     *
     * @param string $name
     * @param array $data
     * @param int $code
     */
    public function __construct($name, $data, $code = 200)
    {
        $this->view = new View($name, $data);
        $this->code = $code;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $this->content = $this->view->build();

        parent::execute();
    }
}
