<?php

namespace JbSilva;

use Dotenv\Dotenv;
use JbSilva\DI\Resolver;
use JbSilva\Router\Router;
use JbSilva\Rederer\PHPRedererInterface;

class App
{
    private $router;
    private $renderer;

    public function __construct()
    {
        $path_info = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->router = new Router($path_info, $method);
    }

    public function setRenderer(PHPRedererInterface $rederer)
    {
        $this->renderer = $rederer;
    }

    public function get(string $path, $fn)
    {
        $this->router->get($path, $fn);
    }

    public function post(string $path, $fn)
    {
        $this->router->post($path, $fn);
    }

    public function run()
    {
        (Dotenv::create(__DIR__ . '/../'))->load();

        $route = $this->router->run();
        $resolver = new Resolver;

        if (is_string($route['callback'])) {
            $controllerAction = explode('@', $route['callback']);

            if (count($controllerAction) !== 2) {
                throw new \Exception("Controle e/ou ação inválidos");
            }

            $controller = $resolver->class(
                'App\Controllers\\' . $controllerAction[0],
                ['params' => $route['params']]
            );

            $action = $controllerAction[1];

            $data = $controller->$action();
        } else {
            $data = $resolver->method($route['callback'], ['params' => $route['params']]);
        }

        $this->renderer->setData($data);
        $this->renderer->run();
    }
}
