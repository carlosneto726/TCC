CREATE TABLE tb_cooperativas
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 img VARCHAR(255),  
 nome VARCHAR(255) NOT NULL,  
 tipo VARCHAR(255) NOT NULL,  
 historico VARCHAR(255),  
 missao VARCHAR(255),  
 visao VARCHAR(255),  
 valores VARCHAR(255),  
 endereco VARCHAR(255) NOT NULL,  
 cep VARCHAR(255) NOT NULL,  
 cnpj VARCHAR(255) NOT NULL,  
 email VARCHAR(255) NOT NULL,  
 senha VARCHAR(255) NOT NULL,  
 tel1 INT NOT NULL,  
 tel2 INT,  
 whatsapp VARCHAR(255),  
 instagram VARCHAR(255),  
 facebook VARCHAR(255),  
 descricao VARCHAR(255),  
 avaliacao INT,  
 UNIQUE (cnpj),
 UNIQUE (email)
); 

CREATE TABLE tb_usuarios 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 nome VARCHAR(255) NOT NULL,  
 email VARCHAR(255) NOT NULL,  
 endereco VARCHAR(255) NOT NULL,  
 cep VARCHAR(255) NOT NULL,  
 senha VARCHAR(255) NOT NULL,  
 cpf VARCHAR(255) NOT NULL,  
 UNIQUE (email,cpf)
); 

CREATE TABLE tb_produtos
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_cooperativa INT,  
 nome VARCHAR(255) NOT NULL,  
 estrelas INT,  
 descricao VARCHAR(255),  
 preco FLOAT,  
 quantidade INT,  
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id)
); 

CREATE TABLE tb_imagens_produto 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 url VARCHAR(255),  
 id_produto INT NOT NULL,  
 FOREIGN KEY(id_produto) REFERENCES tb_produtos (id)
); 

CREATE TABLE tb_comentarios_produto 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 titulo VARCHAR(255) NOT NULL,  
 comentario VARCHAR(255),  
 id_produto INT,  
 id_usuario INT,  
 estrelas INT,  
 FOREIGN KEY(id_produto) REFERENCES tb_produtos (id),
 FOREIGN KEY(id_usuario) REFERENCES tb_usuarios (id)
); 

CREATE TABLE tb_carrosel_cooperativa 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 url VARCHAR(255),  
 id_cooperativa INT,  
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id)
); 

CREATE TABLE tb_pedidos
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    data DATE,
    status char,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(id)
);

CREATE TABLE tb_itens_pedido 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_produto INT NOT NULL,  
 id_pedido INT NOT NULL,  
 quantidade INT NOT NULL,  
 FOREIGN KEY(id_produto) REFERENCES tb_produtos (id),
 FOREIGN KEY(id_pedido) REFERENCES tb_pedidos (id)
); 

CREATE TABLE tb_carrinhos 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_produto INT,  
 id_usuario INT NOT NULL,  
 quantidade INT,  
 FOREIGN KEY(id_produto) REFERENCES tb_produtos (id),
 FOREIGN KEY(id_usuario) REFERENCES tb_usuarios (id)
); 

CREATE TABLE tb_favoritos 
( 
 id INT PRIMARY KEY,  
 id_usuario INT NOT NULL,  
 id_produto INT,  
 FOREIGN KEY(id_usuario) REFERENCES tb_usuarios (id),
 FOREIGN KEY(id_produto) REFERENCES tb_produtos (id)
); 

CREATE TABLE tb_caixa 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_cooperativa INT NOT NULL,  
 data DATE NOT NULL,  
 entrada INT,  
 saida INT,  
 descricao VARCHAR(255),  
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id)
); 

CREATE TABLE tb_forum 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 titulo VARCHAR(255) NOT NULL,  
 descricao INT,  
 estrelas INT,  
 data DATE NOT NULL,  
 id_cooperativa INT NOT NULL,  
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id)
); 

CREATE TABLE tb_vendas 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_pedido INT NOT NULL,  
 data DATE NOT NULL,  
 FOREIGN KEY(id_pedido) REFERENCES tb_pedidos (id)
); 

CREATE TABLE tb_comentarios 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 comentario VARCHAR(255) NOT NULL,  
 id_forum INT NOT NULL,  
 id_cooperativa INT,  
 id_parent INT,
 data DATE NOT NULL,  
 FOREIGN KEY(id_forum) REFERENCES tb_forum (id),
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id),
 FOREIGN KEY(id_parent) REFERENCES tb_comentarios (id)
); 

CREATE TABLE tb_chat 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_cooperativa INT NOT NULL,  
 id_usuario INT NOT NULL,  
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id),
 FOREIGN KEY(id_usuario) REFERENCES tb_usuarios (id)
); 

CREATE TABLE tb_mensagens_usuario 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_usuario INT NOT NULL,  
 id_chat INT NOT NULL,  
 data DATE NOT NULL,  
 FOREIGN KEY(id_usuario) REFERENCES tb_usuarios (id),
 FOREIGN KEY(id_chat) REFERENCES tb_chat (id)
); 

CREATE TABLE tb_mensagens_cooperativa 
( 
 id INT PRIMARY KEY AUTO_INCREMENT,  
 id_cooperativa INT NOT NULL,  
 id_chat INT NOT NULL,  
 data DATE NOT NULL,  
 FOREIGN KEY(id_cooperativa) REFERENCES tb_cooperativas (id),
 FOREIGN KEY(id_chat) REFERENCES tb_chat (id)
); 
