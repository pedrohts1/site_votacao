<?php
// Model - Entidade Ideia
class Ideia {
    private $id;
    private $titulo;
    private $descricao;
    private $usuario_id;

    // Construtor
    public function __construct($titulo = '', $descricao = '', $usuario_id = null) {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->usuario_id = $usuario_id;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
}
?>
