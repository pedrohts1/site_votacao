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
        
        // Rotas para votação (CRUD)
        $this->routes['/votacao'] = [
            'controller' => 'VotacaoController',
            'action' => 'index'
        ];
        
        $this->routes['/votacao/create'] = [
            'controller' => 'VotacaoController',
            'action' => 'create'
        ];
        
        $this->routes['/votacao/store'] = [
            'controller' => 'VotacaoController',
            'action' => 'store'
        ];
        
        $this->routes['/votacao/read'] = [
            'controller' => 'VotacaoController',
            'action' => 'read'
        ];
        
        $this->routes['/votacao/update'] = [
            'controller' => 'VotacaoController',
            'action' => 'update'
        ];
        
        $this->routes['/votacao/delete'] = [
            'controller' => 'VotacaoController',
            'action' => 'delete'
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

