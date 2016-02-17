-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 17-Fev-2016 às 03:47
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `tarefa`
--

INSERT INTO `tarefa` (`codigo`, `titulo`, `descricao`, `prioridade`, `data_inicio`, `data_prazo`, `data_fim`, `encerrada`, `encerrada_por`, `criado_por`, `codigo_projeto`, `codigo_usuario`, `codigo_status`) VALUES
(1, 'Proposta 2', 'Criar e apeesentar projeto com a proposta de desenvovomento do aplicativo', 2, '2016-02-13', '2016-02-16', '2016-02-15', 1, 6, 0, 1, 5, 1),
(2, 'Teste 26', 'huhuhuhu', 2, '2016-02-11', '2016-02-18', '2016-02-14', 1, 6, 0, 2, 7, 1),
(3, 'do Joao', 'lkjlkjlkjkl', 2, '2016-02-14', '2016-02-26', '2016-02-14', 1, 6, 0, 2, 7, 1),
(4, 'Italo', 'gyygygy', 1, '2016-02-12', '2016-02-16', NULL, 1, 6, 6, 2, 9, 1),
(5, 'huhuhu', 'huhuhuh', 3, '2016-02-10', '2016-02-18', '2016-02-15', 1, 6, 0, 2, 9, 1),
(6, 'IgorTeste', 'Teste', 2, '2016-02-15', '2016-02-22', NULL, 1, 6, 0, 3, 8, 0),
(7, 'Teste', 'Teste', 2, '2016-02-15', '2016-02-17', '2016-02-15', 1, 6, 6, 5, 5, 1),
(8, 'testet 2', 'teste', 1, '2016-02-14', '2016-02-17', '2016-02-16', 1, 6, 6, 5, 7, 1),
(9, 'teste2', 'teste', 2, '2016-02-16', '2016-02-17', NULL, 1, 6, 0, 3, 10, 0),
(10, '[po[po[po', 'p[o[p[o[p', 1, '2016-02-16', '2016-02-25', NULL, 1, 6, 0, 3, 4, 0),
(11, 'Iglu', 'IgluDesc', 3, '2016-02-16', '2016-02-19', NULL, 1, 6, 0, 3, 4, 0),
(12, 'Agora sim 2', 'Passou validação', 1, '2016-02-16', '2016-02-23', NULL, 1, 6, 0, 3, 4, 0),
(13, 'uoiuiui', 'iuuiuiui', 1, '2016-02-16', '2016-02-18', '2016-02-16', 1, 6, 6, 5, 5, 1),
(14, 'lkjlkjlkj', 'jkljkljlkj', 3, '2016-02-16', '2016-02-19', '2016-02-16', 1, 6, 6, 5, 5, 1),
(15, 'Ativado', 'ativado', 2, '2016-02-16', '2016-02-18', NULL, 1, 6, 0, 3, 4, 0),
(16, 'Ativado', 'Ativado', 2, '2016-02-16', '2016-02-18', '2016-02-16', 1, 6, 0, 3, 8, 1),
(17, 'jkljk', 'lkjlkjlk', 2, '2016-02-16', '2016-02-18', '2016-02-16', 1, 6, 6, 3, 9, 1),
(18, 'normal', 'normal', 2, '2016-02-16', '2016-02-20', NULL, NULL, NULL, 6, 3, 8, 1),
(19, 'jkljlk', 'jlkjlkj', 2, '2016-02-16', '2016-02-18', NULL, 1, 6, 0, 3, 10, 0),
(20, 'Teste', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarr', 3, '2016-02-16', '2016-02-18', NULL, NULL, NULL, 0, 3, 8, 1),
(21, 'huhuhu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the ', 3, '2016-02-17', '2016-02-20', NULL, NULL, NULL, 6, 3, 8, 1),
(22, 'klk;lkl', 'k;lkl;k', 3, '2016-02-16', '2016-02-19', NULL, NULL, NULL, 6, 1, 11, 1),
(23, 'testete', 'teste', 3, '2016-02-16', '2016-02-25', '2016-02-16', 1, 6, 6, 3, 10, 1),
(24, 'Video Aniversario', 'Cristiano', 2, '2016-02-16', '2016-02-17', NULL, NULL, NULL, 6, 5, 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
