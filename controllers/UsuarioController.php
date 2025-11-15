<?php
// Controller - Controlador para Usuario
class UsuarioController {
    private $usuarioService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }

    // REGISTER - Mostrar formulário de registro
    public function register() {
        $this->render('usuario/register', array());
    }

    // STORE - Processar registro
    public function store() {
        if ($_POST) {
            $nome = $_POST['nome'];
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];

            $resultado = $this->usuarioService->criarUsuario($nome, $email, $senha);

            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
                header('Location: /site_votacao/usuario/login');
            } else {
                $_SESSION['error_message'] = $resultado['message'];
                header('Location: /site_votacao/usuario/register');
            }
            exit;
        }
    }

    // LOGIN - Mostrar formulário de login
    public function login() {
        $this->render('usuario/login', array());
    }

    // AUTHENTICATE - Processar login
    public function authenticate() {
        if ($_POST) {
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];

            $usuario = $this->usuarioService->autenticarUsuario($email, $senha);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuario_nome'] = $usuario->getNome();
                header('Location: /site_votacao/ideia');
            } else {
                $_SESSION['error_message'] = 'Email ou senha inválidos!';
                header('Location: /site_votacao/usuario/login');
            }
            exit;
        }
    }

    // LOGOUT - Processar logout
    public function logout() {
        session_destroy();
        header('Location: /site_votacao/usuario/login');
        exit;
    }

    // Método para renderizar views
    private function render($view, $data = array()) {
        extract($data);
        require_once "views/{$view}.php";
    }
}
?>