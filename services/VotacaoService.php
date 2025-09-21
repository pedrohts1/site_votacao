<?php
// Service - Regras de negócio para Votacao
class VotacaoService {
    private $votacaoDAO;
    
    public function __construct() {
        $this->votacaoDAO = new VotacaoDAO();
    }
    
    // Criar nova votação com validações
    public function criarVotacao($opcao, $votante_nome, $votante_email) {
        // Validações de negócio
        if (empty($opcao) || empty($votante_nome) || empty($votante_email)) {
            return array('success' => false, 'message' => 'Todos os campos são obrigatórios!');
        }
        
        if (!filter_var($votante_email, FILTER_VALIDATE_EMAIL)) {
            return array('success' => false, 'message' => 'Email inválido!');
        }
        
        // Verificar se email já votou
        if ($this->votacaoDAO->verificarEmailJaVotou($votante_email)) {
            return array('success' => false, 'message' => 'Este email já votou!');
        }
        
        // Validar opção
        $opcoesValidas = array('Opção A', 'Opção B', 'Opção C');
        if (!in_array($opcao, $opcoesValidas)) {
            return array('success' => false, 'message' => 'Opção inválida!');
        }
        
        // Criar objeto Votacao
        $votacao = new Votacao($opcao, $votante_nome, $votante_email);
        
        // Salvar no banco
        if ($this->votacaoDAO->create($votacao)) {
            return array('success' => true, 'message' => 'Voto registrado com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao registrar voto!');
        }
    }
    
    // Obter todas as votações
    public function obterTodasVotacoes() {
        return $this->votacaoDAO->readAll();
    }
    
    // Obter votação por ID
    public function obterVotacaoPorId($id) {
        return $this->votacaoDAO->read($id);
    }
    
    // Atualizar votação
    public function atualizarVotacao($id, $opcao, $votante_nome, $votante_email) {
        // Validações
        if (empty($opcao) || empty($votante_nome) || empty($votante_email)) {
            return array('success' => false, 'message' => 'Todos os campos são obrigatórios!');
        }
        
        if (!filter_var($votante_email, FILTER_VALIDATE_EMAIL)) {
            return array('success' => false, 'message' => 'Email inválido!');
        }
        
        // Buscar votação existente
        $votacao = $this->votacaoDAO->read($id);
        if (!$votacao) {
            return array('success' => false, 'message' => 'Votação não encontrada!');
        }
        
        // Atualizar dados
        $votacao->setOpcao($opcao);
        $votacao->setVotanteNome($votante_nome);
        $votacao->setVotanteEmail($votante_email);
        
        if ($this->votacaoDAO->update($votacao)) {
            return array('success' => true, 'message' => 'Votação atualizada com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao atualizar votação!');
        }
    }
    
    // Deletar votação
    public function deletarVotacao($id) {
        if ($this->votacaoDAO->delete($id)) {
            return array('success' => true, 'message' => 'Votação deletada com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao deletar votação!');
        }
    }
    
    // Obter resultados da votação
    public function obterResultados() {
        $resultados = $this->votacaoDAO->contarVotosPorOpcao();
        $total = array_sum($resultados);
        
        $resultadosComPercentual = array();
        foreach ($resultados as $opcao => $votos) {
            $percentual = $total > 0 ? round(($votos / $total) * 100, 1) : 0;
            $resultadosComPercentual[$opcao] = array(
                'votos' => $votos,
                'percentual' => $percentual
            );
        }
        
        return array(
            'resultados' => $resultadosComPercentual,
            'total' => $total
        );
    }
    
    // Buscar votações
    public function buscarVotacoes($termo) {
        if (empty(trim($termo))) {
            return $this->obterTodasVotacoes();
        }
        
        return $this->votacaoDAO->buscar($termo);
    }
}
?>

