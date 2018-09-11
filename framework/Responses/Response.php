<?php

namespace Framework\Responses;

interface Response
{
    /**
     * Flash data to user session as single-use message
     *
     * @param array $data
     * @return $this
     */
    public function withFlash($data);
    /**
     * Flash old data into user session to repopulate form
     *
     * @return $this
     */
    public function withInput();

    /**
     * Output response to user
     */
    public function execute();
}
