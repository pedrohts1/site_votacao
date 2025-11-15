<?php
// Sistema de roteamento simples
class Router {
    private $routes = [];

    public function __construct() {
        $this->defineRoutes();
    }

    private function defineRoutes() {
        // Rota padrão
        $this->routes['/'] = [
            'controller' => 'HomeController',
            'action' => 'index'
        ];

        // Rotas para ideia (CRUD)
        $this->routes['/ideia'] = [
            'controller' => 'IdeiaController',
            'action' => 'index'
        ];

        $this->routes['/ideia/create'] = [
            'controller' => 'IdeiaController',
            'action' => 'create'
        ];

        $this->routes['/ideia/store'] = [
            'controller' => 'IdeiaController',
            'action' => 'store'
        ];

        $this->routes['/ideia/read'] = [
            'controller' => 'IdeiaController',
            'action' => 'read'
        ];

        $this->routes['/ideia/update'] = [
            'controller' => 'IdeiaController',
            'action' => 'update'
        ];

        $this->routes['/ideia/delete'] = [
            'controller' => 'IdeiaController',
            'action' => 'delete'
        ];

        // Rotas para usuario
        $this->routes['/usuario/register'] = [
            'controller' => 'UsuarioController',
            'action' => 'register'
        ];

        $this->routes['/usuario/store'] = [
            'controller' => 'UsuarioController',
            'action' => 'store'
        ];

        $this->routes['/usuario/login'] = [
            'controller' => 'UsuarioController',
            'action' => 'login'
        ];

        $this->routes['/usuario/authenticate'] = [
            'controller' => 'UsuarioController',
            'action' => 'authenticate'
        ];

        $this->routes['/usuario/logout'] = [
            'controller' => 'UsuarioController',
            'action' => 'logout'
        ];
    }

    public function run() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace('/site_votacao', '', $uri);

        if (empty($uri)) {
            $uri = '/';
        }

        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];
            $controllerName = $route['controller'];
            $actionName = $route['action'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    $controller->$actionName();
                } else {
                    $this->show404();
                }
            } else {
                $this->show404();
            }
        } else {
            $this->show404();
        }
    }

    private function show404() {
        http_response_code(404);
        echo "Página não encontrada!";
    }
}
?>
