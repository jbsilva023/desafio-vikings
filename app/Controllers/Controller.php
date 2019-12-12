<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

class Controller
{
    public function __construct()
    {
    }

    protected function view($view, $data = [])
    {
        $blade = new Blade('app/views', 'app/views/cache');
        return $blade->render($view, $data);
    }
}
