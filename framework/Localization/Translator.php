<?php

namespace Framework\Localization;

class Translator
{
    /**
     * @var array
     */
    protected $blocks = [];

    /**
     * Get current language
     *
     * @return string
     */
    public static function language()
    {
        return session('lang', 'it');
    }

    /**
     * Translate key to current user language
     *
     * @param string $key
     * @param array $data
     * @return string
     */
    public function translate($key, $data = [])
    {
        $tokens = explode(".", $key);

        $block = $this->block($tokens[0]);

        $value = $this->fetchKey($block, $tokens);

        return $this->substituteBindings($value, $data);
    }

    /**
     * Get translation block from memory or disk
     *
     * @param string $name
     * @return array
     */
    protected function block($name)
    {
        if (!isset($this->blocks[$name])) {
            $this->blocks[$name] = $this->loadBlock($name);
        }

        return $this->blocks[$name];
    }

    /**
     * Load translation block from disk
     *
     * @param string $name
     * @return array
     */
    protected function loadBlock($name)
    {
        $file = resources_path('lang/' . static::language() . '/' . $name . '.php');

        if (file_exists($file)) {
            return require($file);
        }

        return [];
    }

    /**
     * Get key from block
     *
     * @param array $block
     * @param array $tokens
     * @return string
     */
    protected function fetchKey($block, $tokens)
    {
        return $block[$tokens[1]] ?? implode(".", $tokens);
    }

    /**
     * Substitute bindings into translated string
     *
     * @param string $string
     * @param array $data
     * @return string
     */
    protected function substituteBindings($string, $data)
    {
        foreach ($data as $key => $value) {
            $string = str_replace(':' . $key, $value, $string);
        }

        return $string;
    }
}
