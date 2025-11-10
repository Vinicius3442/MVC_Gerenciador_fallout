-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Nov-2025 às 14:04
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `senai_produtos`
--
CREATE DATABASE IF NOT EXISTS `senai_produtos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `senai_produtos`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `categoria`) VALUES
(1, 'Stimpak', '150.00', 'Cura'),
(2, 'RadAway', '200.00', 'Cura'),
(3, 'Nuka-Cola', '25.00', 'Bebida'),
(4, 'Nuka-Cola Quantum', '75.00', 'Bebida'),
(5, 'Carne de Radstag', '45.00', 'Comida'),
(6, 'BlamCo Mac & Cheese', '30.00', 'Comida'),
(7, 'Água Purificada', '20.00', 'Bebida'),
(8, 'Água Suja', '5.00', 'Bebida'),
(9, 'Mentats', '55.00', 'Químico'),
(10, 'Jet', '50.00', 'Químico'),
(11, 'Psycho', '60.00', 'Químico'),
(12, 'Buffout', '50.00', 'Químico'),
(13, 'Fuzil de Combate', '450.00', 'Arma'),
(14, 'Pistola 10mm', '120.00', 'Arma'),
(15, 'Munição 10mm (x10)', '20.00', 'Munição'),
(16, 'Munição 5.56mm (x10)', '40.00', 'Munição'),
(17, 'Armadura de Combate (Peito)', '300.00', 'Armadura'),
(18, 'Capacete de Combate', '175.00', 'Armadura'),
(19, 'Traje do Vault 101', '75.00', 'Traje'),
(20, 'Duct Tape', '15.00', 'Lixo'),
(21, 'Cola Maravilha', '20.00', 'Lixo'),
(22, 'Despertador', '10.00', 'Lixo'),
(23, 'Parafuso', '8.00', 'Lixo'),
(24, 'Circuito', '25.00', 'Lixo'),
(25, 'Stealth Boy', '500.00', 'Ajuda'),
(26, 'Revista \"Armas e Balas\"', '100.00', 'Habilidade'),
(27, 'Bobblehead - Força', '1000.00', 'Colecionável'),
(28, 'Mini Nuke', '750.00', 'Munição'),
(29, 'Cerveja Gwinnett Stout', '18.00', 'Bebida'),
(30, 'Tubo de Ventilação', '5.00', 'Lixo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
