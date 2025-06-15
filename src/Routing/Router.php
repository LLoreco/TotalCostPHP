<?php
    namespace App\Routing;
    class Router {
        private $routes = [];

        public function post(string $path, callable $handler): void {
            $this->routes['POST'][$path] = $handler;
        }

        public function dispatch(string $method, string $uri): void {
            if (!isset($this->routes[$method][$uri])) {
                $this->sendResponse(404, ['error' => 'Route not found']);
                return;
            }

            call_user_func($this->routes[$method][$uri]);
        }

        private function sendResponse(int $status, array $data): void {
            http_response_code($status);
            echo json_encode($data);
        }
    }
?>