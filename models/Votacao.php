<?php
// Model - Entidade Votacao
class Votacao {
    private $id;
    private $opcao;
    private $votante_nome;
    private $votante_email;
    private $data_voto;
    
    // Construtor
    public function __construct($opcao = '', $votante_nome = '', $votante_email = '') {
        $this->opcao = $opcao;
        $this->votante_nome = $votante_nome;
        $this->votante_email = $votante_email;
        $this->data_voto = date('Y-m-d H:i:s');
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getOpcao() {
        return $this->opcao;
    }
    
    public function setOpcao($opcao) {
        $this->opcao = $opcao;
    }
    
    public function getVotanteNome() {
        return $this->votante_nome;
    }
    
    public function setVotanteNome($votante_nome) {
        $this->votante_nome = $votante_nome;
    }
    
    public function getVotanteEmail() {
        return $this->votante_email;
    }
    
    public function setVotanteEmail($votante_email) {
        $this->votante_email = $votante_email;
    }
    
    public function getDataVoto() {
        return $this->data_voto;
    }
    
    public function setDataVoto($data_voto) {
        $this->data_voto = $data_voto;
    }
}
?>

