-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 14-Jan-2016 às 07:17
-- Versão do servidor: 5.5.31
-- versão do PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `demandou-prod`
--
CREATE DATABASE IF NOT EXISTS `demandou-prod` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `demandou-prod`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1293eef5aeecf8c1bc8272317f5286220843bb10', '::1', 1452747404, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734373237333b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('33cc87466cf684fa23fa28ab1389cc2a7fba6410', '::1', 1452742546, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734313635373b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('47fc02835a4f04a266030426b1f0abab2af3381c', '::1', 1452746654, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734363338363b636f6469676f5f7573756172696f7c733a313a2234223b6c6f67696e7c733a343a2269676f72223b6e6f6d657c733a343a2249676f72223b736f6272656e6f6d657c733a333a22436861223b636f6469676f5f70657266696c7c733a313a2231223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31353a2269676f722d6176617461722e6a7067223b6c6f6761646f7c623a313b),
('518f5dca325105990b5c7f8ce8efcb080d86e605', '::1', 1452745055, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734353034333b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('5e38fc837dbfe115522fcacdec064d09866bd41b', '::1', 1452744458, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734333831313b636f6469676f5f7573756172696f7c733a313a2234223b6c6f67696e7c733a343a2269676f72223b6e6f6d657c733a343a2249676f72223b736f6272656e6f6d657c733a333a22436861223b636f6469676f5f70657266696c7c733a313a2231223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31353a2269676f722d6176617461722e6a7067223b6c6f6761646f7c623a313b),
('5f1cd2e15f8b0d0c27f744aa292338c7dedb74c7', '::1', 1452743229, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734333033373b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('7a87cae02fa33e439b2849dec61f4eecc98e65d4', '::1', 1452748672, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734383431363b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('9d22c3164c796a6c4aa19c74d332558b2bcd7c5b', '::1', 1452752231, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323735323030393b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('b98fa7de97c6f2d5dc5f9fcbaf36ff8ea45c838d', '::1', 1452750608, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323735303537343b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('c5a952eea172d7af4a1d00e01e57bda18a4deeb5', '::1', 1452747062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734363737313b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('e81f99c7adbcf5968fd3bb077b3cb86e6579cbd6', '::1', 1452744653, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734343634333b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b),
('f6e10e8cccfccc4ecb6bec4117367336174c6149', '::1', 1452749910, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323734393637393b636f6469676f5f7573756172696f7c733a313a2236223b6c6f67696e7c733a363a226e656e65746f223b6e6f6d657c733a373a22416e746f6e696f223b736f6272656e6f6d657c733a343a224e65746f223b636f6469676f5f70657266696c7c733a313a2232223b636f6469676f5f7374617475737c733a313a2231223b6172717569766f5f6176617461727c733a31303a226e656e65746f2e6a7067223b6c6f6761646f7c623a313b);

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacoes_resposta`
--

CREATE TABLE IF NOT EXISTS `observacoes_resposta` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_observacao` int(11) NOT NULL,
  `resposta` varchar(500) NOT NULL,
  `data_resposta` date DEFAULT NULL,
  `inserido_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `observacoes_resposta`
--

INSERT INTO `observacoes_resposta` (`codigo`, `codigo_observacao`, `resposta`, `data_resposta`, `inserido_por`) VALUES
(1, 1, 'NAO!', '2016-01-14', 6),
(2, 2, 'SIMSIMSIMSIM VAI DORMIR!', '2016-01-14', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacoes_status`
--

CREATE TABLE IF NOT EXISTS `observacoes_status` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `observacoes_status`
--

INSERT INTO `observacoes_status` (`codigo`, `nome`) VALUES
(1, 'Em andamento'),
(2, 'Aceita'),
(3, 'Negada'),
(4, 'Finalização forçada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacoes_tipo`
--

CREATE TABLE IF NOT EXISTS `observacoes_tipo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `observacoes_tipo`
--

INSERT INTO `observacoes_tipo` (`codigo`, `tipo`) VALUES
(1, 'Finalização'),
(2, 'Extensão de Prazo'),
(3, 'Finalização Forçada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel`
--

CREATE TABLE IF NOT EXISTS `papel` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `papel`
--

INSERT INTO `papel` (`codigo`, `nome`) VALUES
(1, 'Líder'),
(2, 'Participante'),
(3, 'Coordenador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`codigo`, `nome`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE IF NOT EXISTS `projeto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `prioridade` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_prazo` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `codigo_status` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`codigo`, `titulo`, `descricao`, `prioridade`, `data_inicio`, `data_prazo`, `data_fim`, `criado_por`, `codigo_status`) VALUES
(1, 'Demandou', 'Sistema para gerencia de projetos da DCI', 2, '2016-01-01', '2016-01-31', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tarefa`
--

CREATE TABLE IF NOT EXISTS `projeto_tarefa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_projeto` int(11) NOT NULL,
  `codigo_tarefa` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`codigo`, `nome`) VALUES
(0, 'Desativado'),
(1, 'Ativado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa`
--

CREATE TABLE IF NOT EXISTS `tarefa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `prioridade` int(1) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_prazo` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `encerrada` tinyint(4) DEFAULT NULL,
  `encerrada_por` int(11) DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `codigo_projeto` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_status` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tarefa`
--

INSERT INTO `tarefa` (`codigo`, `titulo`, `descricao`, `prioridade`, `data_inicio`, `data_prazo`, `data_fim`, `encerrada`, `encerrada_por`, `criado_por`, `codigo_projeto`, `codigo_usuario`, `codigo_status`) VALUES
(1, 'Identidade Visual', 'Identidade visual by Igor Cha.', 3, '2016-01-01', '2016-01-08', NULL, 1, 6, 5, 1, 4, 1),
(2, 'Layout', 'Joao entrega layout.', 3, '2016-01-11', '2016-01-15', '2016-01-14', 1, 6, 5, 1, 7, 1),
(3, 'Versão Beta do Demandou', 'Márcio entrega versão beta.', 2, '2016-01-18', '2016-01-22', NULL, NULL, NULL, 5, 1, 5, 1),
(4, 'Avaliação', 'Neto avalia Demandou', 1, '2016-01-25', '2016-01-26', NULL, NULL, NULL, 5, 1, 6, 1),
(5, 'Versão Beta 2', 'Márcio entrega Beta 2.', 1, '2016-01-27', '2016-01-31', NULL, NULL, NULL, 5, 1, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa_observacoes`
--

CREATE TABLE IF NOT EXISTS `tarefa_observacoes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `observacao` varchar(500) NOT NULL,
  `data_criada` date NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_status_obs` int(11) DEFAULT NULL,
  `codigo_tarefa` int(11) NOT NULL,
  `inserido_por` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tarefa_observacoes`
--

INSERT INTO `tarefa_observacoes` (`codigo`, `observacao`, `data_criada`, `codigo_tipo`, `codigo_status_obs`, `codigo_tarefa`, `inserido_por`) VALUES
(1, 'primeira?', '2016-01-14', 1, 3, 2, 7),
(2, 'SEGUNDA?', '2016-01-14', 1, 2, 2, 7),
(3, 'forcei igor', '2016-01-14', 3, NULL, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `arquivo_avatar` varchar(200) NOT NULL,
  `data_criado` date NOT NULL,
  `codigo_funcao` int(11) NOT NULL,
  `codigo_perfil` int(11) NOT NULL,
  `codigo_status` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `login`, `senha`, `email`, `nome`, `sobrenome`, `data_nascimento`, `arquivo_avatar`, `data_criado`, `codigo_funcao`, `codigo_perfil`, `codigo_status`) VALUES
(4, 'igor', '7c67e713a4b4139702de1a4fac672344', 'igorcha@secom.pa.gov.br', 'Igor', 'Cha', '2001-01-01', 'igor-avatar.jpg', '2015-12-17', 4, 1, 1),
(5, 'mlp', '7c67e713a4b4139702de1a4fac672344', 'marciopassosbel@gmail.com', 'Márcio', 'Passos', '1981-04-13', 'avatar3.jpg', '2015-12-17', 3, 2, 1),
(6, 'neneto', '7c67e713a4b4139702de1a4fac672344', 'antonioneto@secom.pa.gov.br', 'Antonio', 'Neto', '2001-01-01', 'neneto.jpg', '2015-12-17', 1, 2, 1),
(7, 'joao', '7c67e713a4b4139702de1a4fac672344', 'joaolemos@secom.pa.gov.br', 'João', 'Lemos', '2010-10-10', 'joao.jpg', '2015-12-17', 4, 1, 1),
(8, 'vini', '7c67e713a4b4139702de1a4fac672344', 'viniciusmonteiro@secom.pa.gov.br', 'Vinicius', 'Monteiro', '2002-02-20', 'vinicius.jpg', '2015-12-17', 2, 1, 1),
(9, 'italo', '7c67e713a4b4139702de1a4fac672344', 'italo.torres@secom.pa.gov.br', 'Ítalo', 'Torres', '1990-11-11', 'italo.jpg', '2015-12-17', 2, 1, 1),
(10, 'pet', '7c67e713a4b4139702de1a4fac672344', 'pettersonfariassecom@gmail.com', 'Petterson', 'Farias', '1993-12-12', 'pet.jpg', '2015-12-17', 2, 1, 1),
(11, 'carolina', '7c67e713a4b4139702de1a4fac672344', 'carolinaventurini@icloud.com', 'Carolina', 'Venturini Passos', '2005-09-05', '12113508_10204682176965630_8757563117268102190_o.jpg', '2015-12-23', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_acesso`
--

CREATE TABLE IF NOT EXISTS `usuario_acesso` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_usuario` int(11) NOT NULL,
  `data_acesso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_funcao`
--

CREATE TABLE IF NOT EXISTS `usuario_funcao` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `usuario_funcao`
--

INSERT INTO `usuario_funcao` (`codigo`, `titulo`) VALUES
(1, 'Diretor'),
(2, 'Assessor de Comunicação'),
(3, 'Analista de Sistemas'),
(4, 'Designer Gráfico'),
(5, 'Estagiário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_projeto`
--

CREATE TABLE IF NOT EXISTS `usuario_projeto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_projeto` int(11) NOT NULL,
  `codigo_papel` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuario_projeto`
--

INSERT INTO `usuario_projeto` (`codigo`, `codigo_usuario`, `codigo_projeto`, `codigo_papel`) VALUES
(1, 6, 1, 1),
(2, 4, 1, 2),
(3, 5, 1, 2),
(4, 7, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_tarefa`
--

CREATE TABLE IF NOT EXISTS `usuario_tarefa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_tarefa` int(11) NOT NULL,
  `codigo_papel` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
