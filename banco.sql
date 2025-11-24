CREATE DATABASE mvc_votacao;
USE mvc_votacao;

CREATE TABLE usuarios ( 
 id INT AUTO_INCREMENT PRIMARY KEY, 
 nome VARCHAR(100) NOT NULL, 
 email VARCHAR(100) UNIQUE NOT NULL, 
 senha VARCHAR(255) NOT NULL 
); 

CREATE TABLE ideias ( 
 id INT AUTO_INCREMENT PRIMARY KEY, 
 titulo VARCHAR(150) NOT NULL, 
 descricao TEXT NOT NULL, 
 usuario_id INT, 
 FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
); 

CREATE TABLE votos ( 
 id INT AUTO_INCREMENT PRIMARY KEY, 
 usuario_id INT, 
 ideia_id INT, 
 FOREIGN KEY (usuario_id) REFERENCES usuarios(id), 
 FOREIGN KEY (ideia_id) REFERENCES ideias(id),
 UNIQUE KEY unique_voto (usuario_id, ideia_id) 
);

-- Inserir um usuário de teste (Senha: 123)
INSERT INTO usuarios (nome, email, senha) VALUES ('Aluno Teste', 'aluno@teste.com', '123');