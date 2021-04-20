<?php

namespace App;

class View
{
    /**
     * The base view path
     *
     * @var string
     */
    protected $basePath = __DIR__ . '/../views/';

    /**
     * Render a view template
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    public function render(string $viewName, $data = [])
    {
        $path = "{$this->basePath}{$viewName}.php";

        if (is_file($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        }
        return '';
    }
}
