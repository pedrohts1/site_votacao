<?php
// Controller - Controlador para Estatísticas
class StatsController {
    private $votacaoService;
    
    public function __construct() {
        $this->votacaoService = new VotacaoService();
    }
    
    // Mostrar estatísticas detalhadas
    public function index() {
        $resultados = $this->votacaoService->obterResultados();
        $votacoes = $this->votacaoService->obterTodasVotacoes();
        
        // Estatísticas adicionais
        $stats = $this->calcularEstatisticas($votacoes);
        
        $this->render('stats/index', array(
            'resultados' => $resultados,
            'votacoes' => $votacoes,
            'stats' => $stats
        ));
    }
    
    // Calcular estatísticas adicionais
    private function calcularEstatisticas($votacoes) {
        $total = count($votacoes);
        $hoje = date('Y-m-d');
        $votosHoje = 0;
        $votosPorDia = array();
        
        foreach ($votacoes as $votacao) {
            $data = date('Y-m-d', strtotime($votacao->getDataVoto()));
            if ($data == $hoje) {
                $votosHoje++;
            }
            
            if (!isset($votosPorDia[$data])) {
                $votosPorDia[$data] = 0;
            }
            $votosPorDia[$data]++;
        }
        
        return array(
            'total' => $total,
            'votosHoje' => $votosHoje,
            'votosPorDia' => $votosPorDia,
            'mediaPorDia' => $total > 0 ? round($total / max(1, count($votosPorDia)), 2) : 0
        );
    }
    
    // Método para renderizar views
    private function render($view, $data = array()) {
        extract($data);
        require_once "views/{$view}.php";
    }
}
?>
