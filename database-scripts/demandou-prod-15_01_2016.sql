-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 15-Jan-2016 às 06:50
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
-- Estrutura da tabela `observacoes_resposta`
--

CREATE TABLE IF NOT EXISTS `observacoes_resposta` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_observacao` int(11) NOT NULL,
  `resposta` varchar(500) NOT NULL,
  `data_resposta` date DEFAULT NULL,
  `inserido_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `observacoes_resposta`
--

INSERT INTO `observacoes_resposta` (`codigo`, `codigo_observacao`, `resposta`, `data_resposta`, `inserido_por`) VALUES
(1, 2, 'blz', '2016-01-15', 6),
(2, 1, 'Nao valeu!', '2016-01-15', 6),
(3, 4, 'Foi!', '2016-01-15', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
