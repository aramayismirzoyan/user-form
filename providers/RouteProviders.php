<?php

namespace Providers;

use App\Helpers\Request;
use App\Helpers\Response;
use App\UserController;
use Exception;

class RouteProviders
{
    private array $config;
    public function __construct()
    {
        $this->config = include('./config/routes.php');
    }

    private function hasAction($controller, $action): bool
    {
        return class_exists($controller) && method_exists($controller, $action);
    }

    public function run(): void
    {
        $requestUri = strtok($_SERVER["REQUEST_URI"], '?');

        if(array_key_exists($requestUri, $this->config)) {
            $controller = 'App\\' . $this->config[$requestUri][0];
            $action = $this->config[$requestUri][1];
            $method = $this->config[$requestUri][2];

            if($this->hasAction($controller, $action) && Request::isValidType($method)) {
                (new $controller)->$action();
            } else {
                Response::sendNotFoundError();
            }
        } else {
            Response::sendNotFoundError();
        }
    }
}