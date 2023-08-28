--
-- Banco de dados: `db_cooperativasunidas`
--

CREATE TABLE `tb_cooperativas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL UNIQUE,
  `email` varchar(255) NOT NULL UNIQUE,
  `senha` varchar(255) NOT NULL,
  `tel1` int(11) NOT NULL,
  `tel2` int(11) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `historico` varchar(255) DEFAULT NULL,
  `missao` varchar(255) DEFAULT NULL,
  `visao` varchar(255) DEFAULT NULL,
  `valores` varchar(255) DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `perfil` varchar(255) NOT NULL,
  `outdoor` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `ativa` int(1) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `medida` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `deslikes` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `entrega` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_cooperativa`) REFERENCES `tb_cooperativas` (`id`)
);

CREATE TABLE `tb_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data` date NOT NULL,
  `id_cooperativa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_cooperativa`) REFERENCES `tb_cooperativas` (`id`)
);

CREATE TABLE `tb_comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(255) NOT NULL,
  `id_forum` int(11) NOT NULL,
  `id_cooperativa` int(11) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_forum`) REFERENCES `tb_forum` (`id`),
  FOREIGN KEY (`id_cooperativa`) REFERENCES `tb_cooperativas` (`id`),
  FOREIGN KEY (`id_parent`) REFERENCES `tb_comentarios` (`id`)
);

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL UNIQUE,
  `token` varchar(255) NOT NULL,
  `ativa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tb_chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_cooperativa`) REFERENCES `tb_cooperativas` (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
);

CREATE TABLE `tb_mensagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_chat` int(11) NOT NULL,
  `id_cooperativa` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensagem` varchar(255) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_chat`) REFERENCES `tb_chats` (`id`),
  FOREIGN KEY (`id_cooperativa`) REFERENCES `tb_cooperativas` (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
);

CREATE TABLE `tb_carrinhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
);

CREATE TABLE `tb_comentarios_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `deslikes` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
);

CREATE TABLE `tb_favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`),
  FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
);

CREATE TABLE `tb_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
);

CREATE TABLE `tb_itens_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`),
  FOREIGN KEY (`id_pedido`) REFERENCES `tb_pedidos` (`id`)
);

CREATE TABLE `tb_vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `data` date NOT NULL,
  `preco_total` float NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_pedido`) REFERENCES `tb_pedidos` (`id`)
);