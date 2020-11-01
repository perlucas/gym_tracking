<?php

namespace Core\Controllers;
use flight\Engine;

abstract class BaseController
{
    /**
     * framework instance
     *
     * @var Engine
     */
    protected $app;

    /**
     * layout => php view file mapping
     *
     * @var array
     */
    protected $layouts = [
        'web' => 'layouts/web'
    ];

    /**
     * instantiates this controller
     *
     * @param Engine $appInstance
     */
    public function __construct(Engine $appInstance) {
        $this->app = $appInstance;
    }

    /**
     * forces the file download
     *
     * @param string $file - path to file
     * @return void
     */
    protected function downloadFile($file) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        flush(); // Flush system output buffer
        readfile($file);
    }
}
