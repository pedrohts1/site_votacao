<?php
// Controller - Controlador para Home
class HomeController {
    
    public function index() {
        $this->render('home/index', array(
            'title' => 'Sistema de Votação',
            'message' => 'Bem-vindo ao sistema de votação online!'
        ));
    }
    
    // Método para renderizar views
    private function render($view, $data = array()) {
        extract($data);
        require_once "views/{$view}.php";
    }
}
?>
