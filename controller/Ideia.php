<?php
namespace controller;
use service\IdeiaService;
use template\IdeiaTemp;

class Ideia {
    private $template;
    private $service;

    public function __construct() {
        $this->template = new IdeiaTemp();
        $this->service = new IdeiaService();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // --- MVC WEB ---

    private function verificarLogin() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /mvc_votacao/login/form");
            exit;
        }
    }

    public function listar() {
        try {
            $dados = ['lista' => $this->service->listarIdeias()];
            $this->template->layout("public/ideia/listar.php", $dados);
        } catch (\Exception $e) {
            echo "Erro ao carregar dados: " . $e->getMessage();
        }
    }

    public function formulario() {
        $this->verificarLogin();
        $dados = [];
        if (isset($_GET['id'])) {
            try {
                $dados['ideia'] = $this->service->buscarIdeia($_GET['id']);
            } catch (\Exception $e) { echo $e->getMessage(); }
        }
        $this->template->layout("public/ideia/form.php", $dados);
    }

    public function salvar($titulo, $descricao) {
        $this->verificarLogin();
        $id = $_POST['id'] ?? null;
        try {
            $this->service->salvarIdeia($titulo, $descricao, $_SESSION['usuario_id'], $id);
            header("Location: /mvc_votacao/ideia/listar");
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."'); history.back();</script>";
        }
    }

    public function excluir($id) {
        $this->verificarLogin();
        try {
            $this->service->excluirIdeia($id);
            header("Location: /mvc_votacao/ideia/listar");
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."'); history.back();</script>";
        }
    }

    public function votar($id) {
        $this->verificarLogin();
        try {
            $this->service->votar($_SESSION['usuario_id'], $id);
            header("Location: /mvc_votacao/ideia/listar");
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."'); history.back();</script>";
        }
    }

    // --- API ---

    public function apiListar() {
        try {
            return $this->service->listarIdeias();
        } catch (\Exception $e) {
            // API Retorno JSON limpo em caso de erro
            return ['erro' => $e->getMessage()];
        }
    }

    public function apiCriar($titulo, $descricao) {
        // Pega ID do token JWT 
        try {
            $usuario_id = 1; 
            $res = $this->service->salvarIdeia($titulo, $descricao, $usuario_id);
            return ['sucesso' => true, 'mensagem' => 'Ideia criada com sucesso'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }

    public function apiEditar($id, $titulo, $descricao) {
        try {
            $usuario_id = 1; 
            
            $this->service->salvarIdeia($titulo, $descricao, $usuario_id, $id);
            
            return ['sucesso' => true, 'mensagem' => 'Ideia atualizada com sucesso'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }

    public function apiExcluir($id) {
        try {
            $this->service->excluirIdeia($id);
            return ['sucesso' => true, 'mensagem' => 'Ideia excluída com sucesso'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }
}