<?php

namespace App\Controllers;

use Framework\Controllers\Controller;
use Framework\Responses\Response;

/**
 * Storage controller
 *
 * @package App\controllers
 */
class StorageController extends Controller
{
    /**
     * Display an image
     *
     * @return string|Response
     */
    public function image()
    {
        // NOT a secure mitigation, just a quick one
        $file = str_replace('/', '', $this->request->get('file', ''));

        $path = storage_path("images/{$file}");

        if (file_exists($path)) {
            header('Content-type: ' . mime_content_type($path));

            // This should not be used, it's too slow compared to letting the webserver handle it.
            // We don't know if apache follows symlinks or has mod_xsendfile,
            // so this is guaranteed to work (most of the time).
            readfile($path);

            return '';
        }

        return $this->view('error.404', [], 404);
    }
}
