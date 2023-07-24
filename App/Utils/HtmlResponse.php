<?php

namespace App\Utils;

class HtmlResponse
{
    private $viewPath;
    private $attributes;
    public $statusCode;

    public function __construct($viewPath, $attributes = [], $statusCode = 200)
    {
        $this->viewPath  = $viewPath;
        $this->attributes = $attributes;
        $this->statusCode = $statusCode;
    }

    public static function make($fileName, $attributes = [])
    {
        $viewPath = PUBLIC_PATH . '\\' . $fileName . '.php';

        if (! file_exists($viewPath)) 
        {
            Response::make('404', 'File' . $fileName . 'not exists')->send();
        }
        
        return new static($viewPath, $attributes);
    }

    public function send()
    {
        ob_start();
        extract($this->attributes);
        include $this->viewPath;
        $content = ob_get_clean();

        header('Content-Type: text/html');
        echo $content;
    }
}
