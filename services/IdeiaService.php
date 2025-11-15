<?php
// Service - Regras de negócio para Ideia
class IdeiaService {
    private $ideiaDAO;

    public function __construct() {
        $this->ideiaDAO = new IdeiaDAO();
    }

    // Criar nova ideia com validações
    public function criarIdeia($titulo, $descricao, $usuario_id) {
        // Validações de negócio
        if (empty($titulo) || empty($descricao) || empty($usuario_id)) {
            return array('success' => false, 'message' => 'Todos os campos são obrigatórios!');
        }

        // Criar objeto Ideia
        $ideia = new Ideia($titulo, $descricao, $usuario_id);

        // Salvar no banco
        if ($this->ideiaDAO->create($ideia)) {
            return array('success' => true, 'message' => 'Ideia registrada com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao registrar ideia!');
        }
    }

    // Obter todas as ideias
    public function obterTodasIdeias() {
        return $this->ideiaDAO->readAll();
    }

    // Obter ideia por ID
    public function obterIdeiaPorId($id) {
        return $this->ideiaDAO->read($id);
    }

    // Atualizar ideia
    public function atualizarIdeia($id, $titulo, $descricao, $usuario_id) {
        // Validações
        if (empty($titulo) || empty($descricao) || empty($usuario_id)) {
            return array('success' => false, 'message' => 'Todos os campos são obrigatórios!');
        }

        // Buscar ideia existente
        $ideia = $this->ideiaDAO->read($id);
        if (!$ideia) {
            return array('success' => false, 'message' => 'Ideia não encontrada!');
        }

        // Atualizar dados
        $ideia->setTitulo($titulo);
        $ideia->setDescricao($descricao);
        $ideia->setUsuarioId($usuario_id);

        if ($this->ideiaDAO->update($ideia)) {
            return array('success' => true, 'message' => 'Ideia atualizada com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao atualizar ideia!');
        }
    }

    // Deletar ideia
    public function deletarIdeia($id) {
        if ($this->ideiaDAO->delete($id)) {
            return array('success' => true, 'message' => 'Ideia deletada com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao deletar ideia!');
        }
    }

    // Buscar ideias
    public function buscarIdeias($termo) {
        if (empty(trim($termo))) {
            return $this->obterTodasIdeias();
        }

        return $this->ideiaDAO->buscar($termo);
    }
}
?>
