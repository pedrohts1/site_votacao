<?php
// Service - Regras de negócio para Usuario
class UsuarioService {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    // Criar novo usuario com validações
    public function criarUsuario($nome, $email, $senha) {
        // Validações de negócio
        if (empty($nome) || empty($email) || empty($senha)) {
            return array('success' => false, 'message' => 'Todos os campos são obrigatórios!');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return array('success' => false, 'message' => 'Email inválido!');
        }

        // Verificar se email já existe
        if ($this->usuarioDAO->readByEmail($email)) {
            return array('success' => false, 'message' => 'Este email já está em uso!');
        }

        // Criptografar senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Criar objeto Usuario
        $usuario = new Usuario($nome, $email, $senhaHash);

        // Salvar no banco
        if ($this->usuarioDAO->create($usuario)) {
            return array('success' => true, 'message' => 'Usuário registrado com sucesso!');
        } else {
            return array('success' => false, 'message' => 'Erro ao registrar usuário!');
        }
    }

    // Autenticar usuario
    public function autenticarUsuario($email, $senha) {
        $usuario = $this->usuarioDAO->readByEmail($email);

        if ($usuario && password_verify($senha, $usuario->getSenha())) {
            return $usuario;
        }

        return null;
    }
}
?>