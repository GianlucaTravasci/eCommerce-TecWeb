<?php

namespace App\Controllers;

use Framework\Controllers\Controller;

/**
 * Manage user language
 *
 * @package App\controllers
 */
class LanguageController extends Controller
{
    /**
     * Available languages
     *
     * @var array
     */
    const LANGUAGES = [
        'en',
        'it',
    ];

    /**
     * Update user language
     *
     * @return string
     */
    public function update()
    {
        $lang = $this->request['lang'];

        if (!is_null($lang) && in_array($lang, static::LANGUAGES)) {
            session()->set('lang', $lang);
        }

        return $this->redirect('/');
    }
}
