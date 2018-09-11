<?php

if (!function_exists('asset')) {
    /**
     * Return path to a given asset
     *
     * @param string $path
     * @param bool $absolute
     * @return string
     */
    function asset($path, $absolute = false)
    {
        if (env('PRETTY_LINKS', false)) {
            return env('SUBDIRECTORY', '/') . ltrim($path, '/');
        }

        return ($absolute ? '/' : '') . ltrim($path, '/');
    }
}

if (!function_exists('e')) {
    /**
     * Escape HTML special characters in a string.
     *
     * @param string $value
     * @return string
     */
    function e($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if (!function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
     * @param string $manifestDirectory
     * @return string
     */
    function mix($path, $manifestDirectory = '')
    {
        static $manifests = [];

        if (!starts_with($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && !starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        $manifestPath = public_path($manifestDirectory . '/mix-manifest.json');

        if (!isset($manifests[$manifestPath])) {
            if (file_exists($manifestPath)) {
                $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
            } else {
                $manifests[$manifestPath] = [];
            }
        }

        $manifest = $manifests[$manifestPath];

        if (!isset($manifest[$path])) {
            return asset($path);
        }

        return asset($manifestDirectory . $manifest[$path]);
    }
}
