<?php

if (!function_exists('old')) {
    /**
     * Get all input value
     *
     * @param string $key
     * @param mixed $default
     * @return string
     */
    function old($key, $default = null)
    {
        $old = request()->flash('old_input', []);

        return $old[$key] ?? $default;
    }
}

if (!function_exists('trans')) {
    /**
     * Translate key to current user language
     *
     * @param string $key
     * @param array $data
     * @return string
     */
    function trans($key, $data = [])
    {
        static $translator;

        if (is_null($translator)) {
            $translator = new \Framework\Localization\Translator();
        }

        return $translator->translate($key, $data);
    }
}
