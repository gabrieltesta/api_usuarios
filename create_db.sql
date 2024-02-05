CREATE DATABASE api_usuarios;

-- Criação de tabela de usuários
DROP TABLE IF EXISTS api_usuarios.users;
CREATE TABLE IF NOT EXISTS api_usuarios.users(
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    NAME VARCHAR(255) NOT NULL COMMENT 'Nome Completo',
    email VARCHAR(255) NOT NULL COMMENT 'E-mail',
    phone VARCHAR(12) NOT NULL COMMENT 'Telefone',
    gender ENUM('M','F','O') NOT NULL DEFAULT 'O' COMMENT 'Gênero',
    PASSWORD VARCHAR(255) NOT NULL COMMENT 'Senha',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data Criação',
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data Última Alteração',
    PRIMARY KEY (id)
);

-- Seed usuários
INSERT INTO api_usuarios.users(
    NAME,
    email,
    phone,
    gender,
    PASSWORD
)
VALUES(
      'Gabriel Testa',
      'gabrielaugustotesta@gmail.com',
      '011986394488',
      'M',
      ''
  );


