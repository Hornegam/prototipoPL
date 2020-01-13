-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10/01/2020 às 16:32
-- Versão do servidor: 5.6.46-cll-lve
-- Versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dajedcar_canto_sul`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `cliente_nome` varchar(100) NOT NULL,
  `cliente_cpf` varchar(20) NOT NULL,
  `cliente_telefone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `cliente_nome`, `cliente_cpf`, `cliente_telefone`) VALUES
(1, 'Paulo fernando', '50858135884', '(41) 98746-0588'),
(2, 'Joãozinho', '58742366980', '51567841230'),
(3, 'Peralta teste', '57841233680', '9123547801'),
(4, 'Kabal teste', '41657800349', '1148765034'),
(40, 'Joãozinho', '58742366980', '51567841230'),
(107, 'Elke fabiana', '234567890', '123456789'),
(108, 'Daniel ', '54567', '345678'),
(109, 'Teste', '50858135884', '1238321302'),
(110, 'Testet', '5083o567890', '456789'),
(111, 'Daniel', '50858135884', '1234567'),
(112, 'Daniel', '50858135884', '1238321302'),
(113, 'teste 2', '5678', '4567'),
(114, 'dfghj', 'kdfghjk', 'fghj'),
(115, '234', '2345', '3456'),
(116, 'Daniel Miranda', '50858135884', '12981948265'),
(117, 'daniel', '5', '678567'),
(118, 'Miguel2', '47940164848', '(41) 98746-0588'),
(119, 'Paulo fernand', '56987233568', '41987460588'),
(120, 'cri', '345', '345'),
(121, 'Daniel', '50858135884', '1238321302'),
(122, 'Daniel', '50858135884', '1238321302'),
(123, 'Elke', '23456789', '12973502766'),
(124, 'Daniel teste', '50858135884', '1237383'),
(125, 'Teste2', '5085813883', '163245'),
(126, 'aaaa', '222', '111'),
(127, 'teste', '1', '4567'),
(128, '1', '1', '1'),
(129, '1', '11', '11'),
(130, 'sjkaskj', '45', '56'),
(131, 'kkk', '456', '56'),
(132, '2', '2', '2'),
(133, 'Daniel', '50858135884', '233432'),
(134, 'Daniel', '50858135884', '12981948265'),
(135, 'Daniel', '50858135884', '12'),
(136, 'ssaas', '50858135884', '1238321302'),
(137, 'Daniel Miranda', '50858135884', '12373232'),
(138, 'Daniel Miranda', '50858135884', '1'),
(139, 'teste do contra', '50858135884', '23'),
(140, 'teste certo data', '50858135884', '1'),
(142, 'Daniel Denovo', '50858135884', '(12) 98194-8265'),
(143, '11', '50858135884', '(22) 2222-2222'),
(144, 'Tavolaro', '48224147878', '(12) 9819-4827'),
(145, 'Daniel Teste', '50858135883', '(12) 3832-1302'),
(146, 'Miguel2', '47940164848', '(41) 98746-0588'),
(147, 'Miguel2', '47940164848', '(41) 98746-0588'),
(148, 'Miguel2', '47940164848', '(41) 98746-0588'),
(149, 'Miguel2', '47940164848', '(41) 98746-0588'),
(150, 'Miguel2', '47940164848', '(41) 98746-0588'),
(151, 'Miguel2', '47940164848', '(41) 98746-0588'),
(152, 'Miguel2', '47940164848', '(41) 98746-0588'),
(153, 'Iacara Fariaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '62665726050', '(12) 99876-5432'),
(154, 'Iacara Fariaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '62665726050', '(12) 99876-5432'),
(155, 'Paulo', '50858135884', '(12) 3832-1302');

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes`
--

CREATE TABLE `detalhes` (
  `id` int(11) NOT NULL,
  `detalhes_numero` int(11) NOT NULL,
  `detalhes_descricao` varchar(200) NOT NULL,
  `detalhes_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `detalhes`
--

INSERT INTO `detalhes` (`id`, `detalhes_numero`, `detalhes_descricao`, `detalhes_status`) VALUES
(1, 1, 'Quarto Executivo', 0),
(2, 2, 'Quarto Familiar', 0),
(3, 3, 'Quarto Luxo', 0),
(4, 4, 'Quarto Individual', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `funcionario_cargo` int(11) NOT NULL,
  `funcionario_nome` varchar(150) NOT NULL,
  `funcionario_cpf` varchar(20) NOT NULL,
  `funcionario_telefone` varchar(20) NOT NULL,
  `funcionario_email` varchar(50) NOT NULL,
  `funcionario_endereco` varchar(200) NOT NULL,
  `funcionario_usuario` varchar(35) NOT NULL,
  `funcionario_senha` varchar(100) NOT NULL,
  `funcionario_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `funcionario_cargo`, `funcionario_nome`, `funcionario_cpf`, `funcionario_telefone`, `funcionario_email`, `funcionario_endereco`, `funcionario_usuario`, `funcionario_senha`, `funcionario_ativo`) VALUES
(1, 1, 'Daniel TI', '50858135884', '12981948265', 'miranda.f@aluno.ifsp.edu.br', 'Rua Mathias de Albuquerque, 100', 'daniel.figueiredo', '7c35551b262fcca1bbb0badef3df37f1', 1),
(2, 2, 'Miguel TI', '0000000000', '12996640178', 'mih.velis.mv@gmail.com', 'Rua de teste', 'miguel.dias', '7c35551b262fcca1bbb0badef3df37f1', 1),
(3, 1, 'Gerente', '50858135884', '12981948265', 'miranda.f@aluno.ifsp.edu.br', 'Rua Mathias de Albuquerque, 100', 'gerente', '12345', 1),
(4, 2, 'Locador', '0000000000', '12996640178', 'mih.velis.mv@gmail.com', 'Rua de teste', 'locador', '1234', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario_cargo`
--

CREATE TABLE `funcionario_cargo` (
  `id` int(11) NOT NULL,
  `nome_cargo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `funcionario_cargo`
--

INSERT INTO `funcionario_cargo` (`id`, `nome_cargo`) VALUES
(1, 'Gerente'),
(2, 'Locador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `quartos`
--

CREATE TABLE `quartos` (
  `id` int(11) NOT NULL,
  `fk_detalhes_numero` int(11) NOT NULL,
  `fk_detalhes_descricao` int(11) NOT NULL,
  `fk_cliente_nome` int(11) NOT NULL,
  `quartos_data_entrada` date NOT NULL,
  `quartos_data_saida` date NOT NULL,
  `quartos_valor` double NOT NULL,
  `quartos_info_adicionais` text NOT NULL,
  `quartos_qtd_hospedes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `quartos`
--

INSERT INTO `quartos` (`id`, `fk_detalhes_numero`, `fk_detalhes_descricao`, `fk_cliente_nome`, `quartos_data_entrada`, `quartos_data_saida`, `quartos_valor`, `quartos_info_adicionais`, `quartos_qtd_hospedes`) VALUES
(3, 4, 4, 1, '2019-09-29', '2019-09-30', 0, 'so foi pra teste', 3),
(7, 1, 1, 1, '2019-11-02', '2019-11-03', 1111, '', 1),
(25, 4, 4, 116, '2019-10-22', '2019-10-22', 234567, 'bnm,', 2),
(26, 4, 4, 117, '2019-10-05', '2019-10-08', 67, 'daniel', 5),
(27, 1, 1, 118, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(32, 3, 3, 123, '2019-10-01', '2019-10-03', 200, 'Elke fabiana diz que vai ser surubão', 5),
(33, 1, 1, 124, '2019-10-22', '2019-10-23', 222, 'teste de informação adicional', 1),
(34, 1, 1, 125, '2019-10-24', '2019-10-24', 23456, 'ssss', 1),
(43, 1, 1, 134, '2019-10-28', '2019-10-28', 111, '', 3),
(50, 2, 2, 143, '2019-10-14', '2019-10-13', 22.22, '', 2),
(53, 1, 1, 146, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(54, 1, 1, 147, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(55, 1, 1, 148, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(56, 1, 1, 149, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(57, 1, 1, 150, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(58, 1, 1, 151, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(59, 1, 1, 152, '2019-10-13', '2019-10-15', 123.33, 'teste', 2),
(60, 3, 3, 153, '2019-10-26', '2019-10-28', 234455.67, 'Teste teste', 5),
(61, 3, 3, 154, '2019-10-26', '2019-10-28', 234455.67, 'Teste teste', 5);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes`
--
ALTER TABLE `detalhes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_cargo` (`funcionario_cargo`);

--
-- Índices de tabela `funcionario_cargo`
--
ALTER TABLE `funcionario_cargo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `quartos`
--
ALTER TABLE `quartos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome_cliente` (`fk_cliente_nome`),
  ADD KEY `numero_detalhes` (`fk_detalhes_numero`),
  ADD KEY `descricao_detalhes` (`fk_detalhes_descricao`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de tabela `detalhes`
--
ALTER TABLE `detalhes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `funcionario_cargo`
--
ALTER TABLE `funcionario_cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `quartos`
--
ALTER TABLE `quartos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_cargo` FOREIGN KEY (`funcionario_cargo`) REFERENCES `funcionario_cargo` (`id`);

--
-- Restrições para tabelas `quartos`
--
ALTER TABLE `quartos`
  ADD CONSTRAINT `quartos_ibfk_1` FOREIGN KEY (`fk_cliente_nome`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `quartos_ibfk_2` FOREIGN KEY (`fk_detalhes_numero`) REFERENCES `detalhes` (`id`),
  ADD CONSTRAINT `quartos_ibfk_3` FOREIGN KEY (`fk_detalhes_descricao`) REFERENCES `detalhes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
