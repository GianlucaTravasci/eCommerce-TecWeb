<?php

if (!function_exists('common_path')) {
    /**
     * Determines the common base directory of two paths
     *
     * @param string $uriA
     * @param string $uriB
     * @return string
     */
    function common_path($uriA, $uriB)
    {
        $length = min(strlen($uriA), strlen($uriB));

        // Find first not-matching char
        $pos = null;
        for ($i = 0; $i < $length; $i++) {
            if ($uriA[$i] != $uriB[$i]) {
                $pos = $i - 1;
                break;
            }
        }

        if ($pos < 1) {
            return ($uriA[0] == $uriB[0] && $uriA[0] == '/') ? '/' : '';
        }

        // Revert to last /
        if ($uriA[$pos] != '/' || $uriB[$pos] != '/') {
            $pos = strrpos(substr($uriA, 0, $pos), '/');
        }

        return substr($uriA, 0, $pos + 1);
    }
}

if (!function_exists('parse_uri')) {
    /**
     * Parse URI and remove query string and subdirectory
     *
     * @param string $uri
     * @return string
     */
    function parse_uri($uri)
    {
        if (($index = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $index);
        }

        if (starts_with($uri, env('SUBDIRECTORY', '/'))) {
            $uri = substr($uri, strlen(env('SUBDIRECTORY', '/')));
        }

        return '/' . ltrim($uri, '/');
    }
}

if (!function_exists('url_relative_to')) {
    /**
     * Build relative url given a base
     *
     * @param string $url
     * @param string $base
     * @return string
     */
    function url_relative_to($url, $base)
    {
        $common = common_path($url, $base);

        if (empty($common)) {
            return $url;
        }

        $base = substr($base, strlen($common));

        $directoriesCount = substr_count($base, '/');

        return str_repeat('../', $directoriesCount) . ltrim(substr($url, strlen($common)), '/');
    }
}

if (!function_exists('route')) {
    /**
     * Prepend needed directory to route
     *
     * @param  string $path
     * @return string
     */
    function route($path)
    {
        if (env('PRETTY_LINKS', false)) {
            return env('SUBDIRECTORY', '/') . ltrim($path, '/');
        }

        $query = '';

        if (str_contains($path, '?')) {
            $index = strpos($path, '?');
            $query = substr($path, $index + 1);
            $path = substr($path, 0, $index);
        }

        return 'index.php?r=' . urlencode($path) . (empty($query) ? '' : '&' . $query);
    }
}

if (!function_exists('storage')) {
    /**
     * Display link for a file in storage
     *
     * @param string $directory
     * @param string $file
     * @return string
     */
    function storage($directory, $file)
    {
        if (env('DIRECT_STORAGE', false)) {
            return route("/storage/{$directory}/{$file}");
        }

        return route("/storage/{$directory}?file={$file}");
    }
}
