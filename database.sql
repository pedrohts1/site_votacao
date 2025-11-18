-- Script SQL para criar o banco de dados do sistema de votação
-- Execute este script no MySQL antes de usar a aplicação

CREATE DATABASE IF NOT EXISTS site_votacao;
USE site_votacao;

-- Tabela para armazenar as votações
CREATE TABLE IF NOT EXISTS votacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    opcao VARCHAR(50) NOT NULL,
    votante_nome VARCHAR(100) NOT NULL,
    votante_email VARCHAR(100) NOT NULL,
    data_voto TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir algumas opções de exemplo (opcional)
-- INSERT INTO votacoes (opcao, votante_nome, votante_email) VALUES
-- ('Opção A', 'João Silva', 'joao@email.com'),
-- ('Opção B', 'Maria Santos', 'maria@email.com'),
-- ('Opção C', 'Pedro Costa', 'pedro@email.com');

