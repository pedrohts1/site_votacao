<?php
// Controller - Controlador para Ideia
class IdeiaController {
    private $ideiaService;

    public function __construct() {
        $this->ideiaService = new IdeiaService();
    }

    // READ - Listar todas as ideias
    public function index() {
        $termo = $_GET['busca'] ?? '';
        $ideias = $this->ideiaService->buscarIdeias($termo);

        $this->render('ideia/index', array(
            'ideias' => $ideias,
            'termo' => $termo
        ));
    }

    // CREATE - Mostrar formulário de criação
    public function create() {
        $this->render('ideia/create', array());
    }

    // STORE - Processar criação
    public function store() {
        if ($_POST) {
            $titulo = $_POST['titulo'];
            $descricao = trim($_POST['descricao']);
            $usuario_id = $_SESSION['usuario_id']; // Supondo que o ID do usuário está na sessão

            $resultado = $this->ideiaService->criarIdeia($titulo, $descricao, $usuario_id);

            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
            } else {
                $_SESSION['error_message'] = $resultado['message'];
            }

            header('Location: /site_votacao/ideia');
            exit;
        }
    }

    // READ - Mostrar ideia específica
    public function read() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $ideia = $this->ideiaService->obterIdeiaPorId($id);
            if ($ideia) {
                $this->render('ideia/read', array('ideia' => $ideia));
            } else {
                $_SESSION['error_message'] = 'Ideia não encontrada!';
                header('Location: /site_votacao/ideia');
                exit;
            }
        } else {
            header('Location: /site_votacao/ideia');
            exit;
        }
    }

    // UPDATE - Mostrar formulário de edição ou processar atualização
    public function update() {
        if ($_POST) {
            // Processar atualização
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descricao = trim($_POST['descricao']);
            $usuario_id = $_SESSION['usuario_id']; // Supondo que o ID do usuário está na sessão

            $resultado = $this->ideiaService->atualizarIdeia($id, $titulo, $descricao, $usuario_id);

            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
            } else {
                $_SESSION['error_message'] = $resultado['message'];
            }

            header('Location: /site_votacao/ideia');
            exit;
        } else {
            // Mostrar formulário de edição
            $id = $_GET['id'] ?? null;

            if ($id) {
                $ideia = $this->ideiaService->obterIdeiaPorId($id);
                if ($ideia) {
                    $this->render('ideia/update', array('ideia' => $ideia));
                } else {
                    $_SESSION['error_message'] = 'Ideia não encontrada!';
                    header('Location: /site_votacao/ideia');
                    exit;
                }
            } else {
                header('Location: /site_votacao/ideia');
                exit;
            }
        }
    }

    // DELETE - Deletar ideia
    public function delete() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $resultado = $this->ideiaService->deletarIdeia($id);

            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
            } else {
                $_SESSION['error_message'] = $resultado['message'];
            }
        }

        header('Location: /site_votacao/ideia');
        exit;
    }

    // Método para renderizar views
    private function render($view, $data = array()) {
        extract($data);
        require_once "views/{$view}.php";
    }
}
?>
