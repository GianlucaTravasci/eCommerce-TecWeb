<?php

namespace App\Controllers;

use Framework\Controllers\Controller;
use Framework\Localization\Translator;
use Framework\Responses\Response;

/**
 * Controller to display static pages
 *
 * @package App\controllers
 */
class PagesController extends Controller
{
    /**
     * @return Response
     */
    public function info()
    {
        return $this->view('static.' . Translator::language() . '.info');
    }

    /**
     * @return Response
     */
    public function howToBuy()
    {
        return $this->view('static.' . Translator::language() . '.how_to_buy');
    }

    /**
     * @return Response
     */
    public function faq()
    {
        return $this->view('static.' . Translator::language() . '.faq');
    }

    /**
     * @return Response
     */
    public function privacy()
    {
        return $this->view('static.' . Translator::language() . '.privacy');
    }

    /**
     * @return Response
     */
    public function sending()
    {
        return $this->view('static.' . Translator::language() . '.sending');
    }
}
