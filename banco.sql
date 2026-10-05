CREATE DATABASE IF NOT EXISTS loja_estoque CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE loja_estoque;

CREATE TABLE IF NOT EXISTS produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    data_validade DATE NOT NULL,
    CHECK (preco > 0),
    CHECK (quantidade >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, data_validade) VALUES
('Arroz 5kg', 'Alimentacao', 'Pacote de arroz tipo 1, com 5kg.', 24.90, 18, '2026-12-15'),
('Leite Integral', 'Laticinios', 'Caixa com 1 litro de leite integral.', 5.49, 42, '2026-10-20'),
('Feijao Preto', 'Alimentacao', 'Feijao preto de qualidade, pacote de 1kg.', 8.70, 25, '2027-01-10'),
('Pao Frances', 'Padaria', 'Pao frances recem-assado, por unidade.', 0.80, 56, '2026-10-06'),
('Sabo em Po', 'Limpeza', 'Sabo em po para roupas, pacote de 1kg.', 13.50, 12, '2027-02-18');
