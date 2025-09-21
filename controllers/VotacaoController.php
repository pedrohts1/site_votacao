<?php
// Controller - Controlador para Votacao
class VotacaoController {
    private $votacaoService;
    
    public function __construct() {
        $this->votacaoService = new VotacaoService();
    }
    
    // READ - Listar todas as votações
    public function index() {
        $votacoes = $this->votacaoService->obterTodasVotacoes();
        $resultados = $this->votacaoService->obterResultados();
        
        $this->render('votacao/index', array(
            'votacoes' => $votacoes,
            'resultados' => $resultados
        ));
    }
    
    // CREATE - Mostrar formulário de criação
    public function create() {
        $this->render('votacao/create', array());
    }
    
    // STORE - Processar criação
    public function store() {
        if ($_POST) {
            $opcao = $_POST['opcao'];
            $votante_nome = trim($_POST['votante_nome']);
            $votante_email = trim($_POST['votante_email']);
            
            $resultado = $this->votacaoService->criarVotacao($opcao, $votante_nome, $votante_email);
            
            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
            } else {
                $_SESSION['error_message'] = $resultado['message'];
            }
            
            header('Location: /site_votacao/votacao');
            exit;
        }
    }
    
    // READ - Mostrar votação específica
    public function read() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $votacao = $this->votacaoService->obterVotacaoPorId($id);
            if ($votacao) {
                $this->render('votacao/read', array('votacao' => $votacao));
            } else {
                $_SESSION['error_message'] = 'Votação não encontrada!';
                header('Location: /site_votacao/votacao');
                exit;
            }
        } else {
            header('Location: /site_votacao/votacao');
            exit;
        }
    }
    
    // UPDATE - Mostrar formulário de edição ou processar atualização
    public function update() {
        if ($_POST) {
            // Processar atualização
            $id = $_POST['id'];
            $opcao = $_POST['opcao'];
            $votante_nome = trim($_POST['votante_nome']);
            $votante_email = trim($_POST['votante_email']);
            
            $resultado = $this->votacaoService->atualizarVotacao($id, $opcao, $votante_nome, $votante_email);
            
            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
            } else {
                $_SESSION['error_message'] = $resultado['message'];
            }
            
            header('Location: /site_votacao/votacao');
            exit;
        } else {
            // Mostrar formulário de edição
            $id = $_GET['id'] ?? null;
            
            if ($id) {
                $votacao = $this->votacaoService->obterVotacaoPorId($id);
                if ($votacao) {
                    $this->render('votacao/update', array('votacao' => $votacao));
                } else {
                    $_SESSION['error_message'] = 'Votação não encontrada!';
                    header('Location: /site_votacao/votacao');
                    exit;
                }
            } else {
                header('Location: /site_votacao/votacao');
                exit;
            }
        }
    }
    
    // DELETE - Deletar votação
    public function delete() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $resultado = $this->votacaoService->deletarVotacao($id);
            
            if ($resultado['success']) {
                $_SESSION['success_message'] = $resultado['message'];
            } else {
                $_SESSION['error_message'] = $resultado['message'];
            }
        }
        
        header('Location: /site_votacao/votacao');
        exit;
    }
    
    // Método para renderizar views
    private function render($view, $data = array()) {
        extract($data);
        require_once "views/{$view}.php";
    }
}
?>
