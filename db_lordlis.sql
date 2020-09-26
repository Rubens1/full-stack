-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Set-2020 às 01:19
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_imperio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `recover_solicitado`
--

CREATE TABLE `recover_solicitado` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `rash` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recover_solicitado_empresa`
--

CREATE TABLE `recover_solicitado_empresa` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `rash` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.categoria`
--

CREATE TABLE `tb_admin.categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.categoria`
--

INSERT INTO `tb_admin.categoria` (`id`, `categoria`, `slug`, `order_id`) VALUES
(1, 'Acessório', 'acessorio', 1),
(2, 'Roupa', 'roupa', 2),
(3, 'Eletrônico', 'eletronico', 3),
(4, 'Calçado', 'calcado', 4),
(5, 'Móveis', 'moveis', 5),
(6, 'Outros', 'outros', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.colaborado`
--

CREATE TABLE `tb_admin.colaborado` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.colaborado`
--

INSERT INTO `tb_admin.colaborado` (`id`, `user`, `password`, `nome`, `email`, `img`, `cargo`) VALUES
(1, 'admin', 'admin', 'Rubens ', 'rubens.jesus1997@gmail.com', '5e4f3e915ea7c.jpg', 2),
(15, 'caique', '123', 'Caique', 'caique@gmail.com', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.consumido`
--

CREATE TABLE `tb_admin.consumido` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.consumido`
--

INSERT INTO `tb_admin.consumido` (`id`, `nome`, `sobrenome`, `email`, `cpf`, `senha`, `cep`, `estado`, `cidade`, `bairro`, `complemento`, `numero`) VALUES
(1, 'Rubens', 'Nogueira', 'rubens@gmail.com', '065.672.195-21', '$2y$10$rraf4lNMp/pHpCVe.mPxCOHx8PdNuDdIJkd31D/Rv9NDVe.8gc5UK', '85439-873', 'São Paulo', 'São Paulo Capital', 'Jardim Era', 'Av.teste novo', '35'),
(2, 'Rubens', 'Jesus', 'rubens.jesus@labdevelop.com.br', '99999999', '$2y$10$ep4WmH70xQ28KJlt7OyNIOtj.hu1xpwIu.NthcFsjCM0g7lEy94se', '6578925', 'São Paulo', 'Diadema', 'Jardim Teste', 'Rua Testado', '58'),
(3, 'Caique', 'Santos', 'caique@gmail.com', '067.872.389-92', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '33333-333', 'Bahia', 'Salvado', 'Beira', 'rua beirado', '222'),
(4, 'Lucas', 'Santos', 'lucas@gmail.com', '698.555.522-22', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '57484-165', 'Ria de Janeiro', 'Rio de Janeiro', 'Complexo do alemao', 'rua tiraria', '157'),
(5, 'Vitor', 'Silva', 'vitor@gmail.com', '698.555.522-22', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '66545-645', 'Ria de Janeiro', 'Rio de Janeiro', 'Complexo do alemao', 'rua tiraria', '157'),
(6, 'Carlos', 'Silva', 'carlos@gmail.com', '698.555.522-22', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '66545-645', 'Ria de Janeiro', 'Rio de Janeiro', 'Complexo do alemao', 'rua tiraria', '157'),
(7, 'Bruno', 'Dia', 'bruno@gmail.com', '065.672.195-21', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '00000-000', 'Ria de Janeiro', 'Rio de Janeiro', 'Complexo do alemao', 'rua beirado', '22'),
(12, 'Zezito', 'Catete', 'zezito@gmail.com', '624.690.535-87', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '00000-000', 'São Paulo', 'São Paulo', 'Conjunto', 'rua de tal', '22'),
(13, 'Bia', 'Santos', 'bia@gmail.com', '065.672.195-21', '$2y$10$6/1X5n2upplbI.tFLyzB.ON7PXhDxSUv.YEDrS0n1lULxs4Lv2kH.', '33333-333', 'São Paulo', 'São Paulo', 'Conjunto', 'rua de tal', '222'),
(14, 'Junior', 'Santos', 'junior@gmail.com', '941.661.337-13', '$2y$10$G.QJ5g43hAs6WSAc1P1S.ODn4C1lEd.VCdbWBja7Xb/M9wj2iY0CC', '00000-000', 'São Paulo', 'São Paulo', 'Conjunto', 'rua tiraria', '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.estoque`
--

CREATE TABLE `tb_admin.estoque` (
  `id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `tamanho` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `promocao` decimal(10,2) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.estoque`
--

INSERT INTO `tb_admin.estoque` (`id`, `loja_id`, `categoria_id`, `subcategoria_id`, `nome`, `descricao`, `tamanho`, `cor`, `quantidade`, `preco`, `promocao`, `slug`) VALUES
(42, 1, 2, 1, 'novo', 'dsfdsfdsf', 'P,M,G,GG', 'Vermelho', 33, '32.00', '22.00', 'novo'),
(43, 2, 3, 2, 'camisa masculina', 'asfdsdfdgsdfg', 'P , M , G , GG', 'Verde , Vermelho , Branco , Preto', 100, '49.00', '30.00', 'camisa-masculina'),
(44, 1, 1, 2, 'relogio', 'relógio de puço', 'P , M', 'Verde , Vermelho , Branco , Preto', 100, '90.00', '80.00', 'relogio'),
(45, 2, 2, 1, 'hollister', 'camisa da hollister', 'P , M , G , GG', 'Branco', 300, '120.00', '100.00', 'hollister'),
(46, 2, 2, 4, 'Blusa de manga', 'Blusa de manga', 'P , M , G , GG', 'Estampado', 325, '60.00', '0.00', 'blusa-de-manga'),
(47, 2, 2, 4, 'Blusa de manga', 'Blusa de manga', 'P , M , G , GG', 'Estampado', 325, '60.00', '40.00', 'blusa-de-manga'),
(48, 2, 1, 2, 'relogio digital', 'novo relogio com as melhores tecnologia do mercado', '0', 'Estampado , Azul , Amarelo , Branco , Preto , Verde , Vermeio', 119, '90.00', '80.00', 'relogio-digital'),
(49, 2, 1, 2, 'relogio digital', 'novo relogio com as melhores tecnologia do mercado', '0', 'Estampado , Azul , Amarelo , Branco , Preto , Verde , Vermeio', 17, '90.00', '0.00', 'relogio-digital');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.estoque_imagens`
--

CREATE TABLE `tb_admin.estoque_imagens` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.estoque_imagens`
--

INSERT INTO `tb_admin.estoque_imagens` (`id`, `produto_id`, `imagem`) VALUES
(1, 17, '5e42edb092233.jpg'),
(2, 18, '5e49916d8d7fe.jpg'),
(3, 19, '5ed0451a26e7e.jpg'),
(4, 20, '5ed047633bdeb.jpg'),
(5, 21, '5ed0482bdcc99.jpg'),
(6, 23, '5ed049704a033.jpg'),
(7, 24, '5ed049f0844d9.jpg'),
(8, 25, '5ed04cef06dd1.jpg'),
(9, 26, '5ed04f628d792.jpg'),
(12, 29, '5ed19262b6013.jpg'),
(13, 30, '5ed193fe61e26.jpg'),
(14, 31, '5ed19504f34d9.jpg'),
(15, 32, '5ed1974544ba3.jpg'),
(16, 33, '5ed19f8f0b61e.jpg'),
(17, 34, '5ed19fcf58527.jpg'),
(18, 35, '5ed1a1464e5e9.jpg'),
(19, 36, '5ed1a188662db.jpg'),
(20, 37, '5ed1a1e14edf6.jpg'),
(21, 38, '5ed1a35b60dd7.jpg'),
(22, 39, '5ed1a72e513d7.jpg'),
(23, 40, '5ed1b0574040c.jpg'),
(27, 44, '5ed93d5c446ae.jpg'),
(28, 45, '5ed972f4b3fc9.jpg'),
(31, 44, '5eebf1a7be056.jpg'),
(32, 44, '5eebf1a7be676.jpg'),
(33, 44, '5eebf1a7bed4a.jpg'),
(34, 44, '5eebf1a7bf508.jpg'),
(35, 44, '5eebf1d693723.jpg'),
(39, 42, '5eebf2e5c95d6.jpg'),
(40, 42, '5eebf2e5c9ba2.jpg'),
(41, 42, '5eebf2e5ca19c.jpg'),
(42, 42, '5eebf2e5ca8f6.jpg'),
(43, 42, '5eebf2e5caf96.jpg'),
(44, 42, '5eebf2e5cb62b.jpg'),
(55, 43, '5eebf589ed8e7.jpg'),
(56, 43, '5eebf589edeb7.jpg'),
(59, 43, '5eebf589ef4fb.jpg'),
(60, 43, '5eebf5942ebe2.jpg'),
(73, 43, '5eebf6a690ab6.jpg'),
(74, 43, '5eebf6a691269.jpg'),
(75, 46, '5ef4fb0d832a9.jpg'),
(76, 47, '5ef4fbf26590a.jpg'),
(77, 48, '5ef501c69a74c.jpg'),
(78, 49, '5ef5025b1232f.jpg'),
(80, 51, '5efa5dd195825.jpg'),
(81, 47, '5efa627fe9464.jpg'),
(82, 47, '5efa627fe9afe.jpg'),
(83, 47, '5efa627fea286.jpg'),
(91, 46, '5efa688e59cf3.jpg'),
(93, 46, '5efa688e5acfa.jpg'),
(94, 46, '5efa688e5b60f.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.financeiro`
--

CREATE TABLE `tb_admin.financeiro` (
  `id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `vencimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.lojas`
--

CREATE TABLE `tb_admin.lojas` (
  `id` int(11) NOT NULL,
  `empresario` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `loja` varchar(100) NOT NULL,
  `cep` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.lojas`
--

INSERT INTO `tb_admin.lojas` (`id`, `empresario`, `logo`, `email`, `senha`, `cnpj`, `loja`, `cep`, `estado`, `cidade`, `bairro`, `complemento`, `numero`, `slug`) VALUES
(1, 'Vitor Silva', '5f174faa048a9.png', 'nova@gmail.com', '$2y$10$OJ3hVPGoc7GuVuGU.6cxhu09evYU3FKUT3zYGu/1e.1mzKcpbKRcW', '73.525.519/0001-67', 'Nova Era', '08250540', 'São Paulo', 'São Paulo Capital', 'conjunto', 'Av nova', '22', 'nova-era'),
(2, 'Rubens de Jesus Nogueira', '5efa3f5e7fd03.png', 'admin@labdevelop.com.br', '$2y$10$OJ3hVPGoc7GuVuGU.6cxhu09evYU3FKUT3zYGu/1e.1mzKcpbKRcW', '98.577.196/0001-86', 'Lab Develop', '08250545', 'São Paulo', 'São Paulo Capital', 'conjunto', 'rua de tal', '33', 'lab-develop'),
(3, 'Carlos', '', 'admin.novo@labdevelop.com.br', '$2y$10$F6gfQgsv4qv4imAooKjSNeTobb91t3cJmdVLFbbgfC6PhYhKOeFR6', '123344545', 'Testador', '08250549', 'São Paulo', 'São Paulo Capital', 'conjunto', 'Rua nova', '12', 'testador'),
(4, 'Carlos', '', 'carlos@gmail.com', '123456', '53.831.237/0001-80', 'carlos consultoria', '22222-222', 'São Paulo', 'São Paulo', 'Conjunto', 'rua de tal', '222', 'carlos-consultoria'),
(5, 'Banda', '', 'rubens.jesus1997@gmail.com', 'ru19051997', '66.573.368/0001-57', 'Rubens', '22222-222', 'São Paulo', 'São Paulo', 'Conjunto', 'rua novidade', '33', 'rubens'),
(6, 'Bela Compra', '5f1856b44d60d.png', 'bia@gmail.com', '$2y$10$rraf4lNMp/pHpCVe.mPxCOHx8PdNuDdIJkd31D/Rv9NDVe.8gc5UK', '89.873.969/0001-80', 'Bia', '66666-666', 'São Paulo', 'São Paulo', 'Conjunto', 'rua novidade', '33', 'bia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(432, '::1', '2020-07-12 21:03:18', '5f0ba3c20d146'),
(433, '::1', '2020-07-13 20:19:36', '5f0cebe9eca8c'),
(434, '::1', '2020-07-17 20:36:31', '5f0e6f6186065'),
(435, '::1', '2020-07-17 20:39:20', '5f0e6fee1e87f'),
(436, '::1', '2020-07-19 12:41:01', '5f1364eb48842'),
(437, '::1', '2020-07-19 12:41:01', '5f14698d3f7e0'),
(438, '::1', '2020-07-19 17:04:36', '5f14a751dde73'),
(439, '::1', '2020-07-19 17:04:36', '5f14a754b215d'),
(440, '::1', '2020-07-20 15:07:17', '5f15dd5238c9e'),
(441, '::1', '2020-07-20 15:07:17', '5f15dd5530eb5'),
(442, '::1', '2020-07-20 16:43:16', '5f15f3c87fa19'),
(443, '::1', '2020-07-20 17:00:51', '5f15f3d48a54e'),
(444, '::1', '2020-07-20 17:01:55', '5f15f7f345cd0'),
(445, '::1', '2020-07-20 17:03:11', '5f15f8336fb61'),
(446, '::1', '2020-07-20 17:08:17', '5f15f87f96984'),
(447, '::1', '2020-07-20 17:18:55', '5f15f9b1e9f07'),
(448, '::1', '2020-07-20 17:26:10', '5f15fddf07f94'),
(449, '::1', '2020-07-20 17:26:10', '5f15fde2b7fac'),
(450, '::1', '2020-07-21 16:49:36', '5f17046009835'),
(451, '::1', '2020-07-21 16:46:48', '5f174267a186e'),
(452, '::1', '2020-07-21 16:50:05', '5f174628bd9b4'),
(453, '::1', '2020-07-21 17:11:03', '5f174728c2e6f'),
(454, '::1', '2020-07-21 17:11:03', '5f174bd738cf4'),
(455, '::1', '2020-07-21 17:28:57', '5f174fe7f1f2d'),
(456, '::1', '2020-07-21 17:29:18', '5f175009a0a79'),
(457, '::1', '2020-07-21 17:29:18', '5f17501e4a330'),
(458, '::1', '2020-07-21 19:43:41', '5f175350e81fe'),
(459, '::1', '2020-07-21 19:51:31', '5f1771649bad9'),
(460, '::1', '2020-07-22 12:06:28', '5f1855d09590e'),
(461, '::1', '2020-07-22 12:06:28', '5f1855f453476'),
(462, '::1', '2020-07-22 12:08:06', '5f18565288775'),
(463, '::1', '2020-07-22 12:08:06', '5f185656c55f0'),
(464, '::1', '2020-07-22 12:15:35', '5f185783a4c17'),
(465, '::1', '2020-07-22 14:01:28', '5f18581795493'),
(466, '::1', '2020-07-22 14:09:26', '5f1870e85ee82'),
(467, '::1', '2020-08-01 12:02:37', '5f1872fdb2a88'),
(468, '::1', '2020-08-01 18:37:41', '5f25840fa9292'),
(469, '::1', '2020-08-01 18:41:49', '5f25e0a56c4df'),
(470, '::1', '2020-08-02 18:15:02', '5f26df9e36279'),
(471, '::1', '2020-08-02 18:20:59', '5f272d228688d'),
(472, '::1', '2020-08-09 13:24:07', '5f272e180d3a2'),
(473, '::1', '2020-08-08 19:53:37', '5f2736e4b88fb'),
(474, '::1', '2020-08-09 19:46:32', '5f307cc884e79'),
(475, '::1', '2020-08-09 19:46:33', '5f307cc90da9a'),
(476, '127.0.0.1', '2020-08-10 19:36:29', '5f30332ab979b'),
(477, '::1', '2020-08-10 19:41:49', '5f31cd2134b12'),
(478, '::1', '2020-08-14 18:27:36', '5f37013437a3e'),
(479, '::1', '2020-08-19 20:52:42', '5f3dab835c87f'),
(480, '::1', '2020-08-23 19:39:23', '5f42f01a7e056'),
(481, '::1', '2020-08-23 19:39:34', '5f42f026bfd4c'),
(482, '::1', '2020-08-23 19:42:16', '5f42f0c86e6ca'),
(483, '::1', '2020-08-26 21:29:35', '5f46fd90df45b'),
(484, '::1', '2020-08-28 08:34:38', '5f46fe6f2c899'),
(485, '::1', '2020-08-26 21:32:35', '5f46ff23360db'),
(486, '::1', '2020-08-26 21:32:35', '5f46ff236553c'),
(487, '::1', '2020-08-28 08:34:52', '5f48ebd6b44bd'),
(488, '::1', '2020-08-28 08:43:16', '5f48e34144546'),
(489, '::1', '2020-08-28 08:43:38', '5f48ede65b754'),
(490, '::1', '2020-08-28 08:43:41', '5f48edede24f3'),
(491, '::1', '2020-08-28 08:44:23', '5f48ee1723859'),
(492, '::1', '2020-08-28 08:44:23', '5f48ee17454dc'),
(493, '::1', '2020-08-28 08:44:23', '5f48ee1789190'),
(494, '::1', '2020-08-28 08:45:33', '5f48ee5d1aa63'),
(495, '::1', '2020-08-28 13:04:12', '5f492afa14646'),
(496, '::1', '2020-08-28 16:20:54', '5f495916a655d'),
(497, '::1', '2020-08-30 10:59:14', '5f4bb0b19577a'),
(498, '::1', '2020-08-30 11:00:10', '5f4bb0bb71951'),
(499, '::1', '2020-08-30 11:00:22', '5f4bb0f2e5fd7'),
(500, '::1', '2020-08-30 11:00:53', '5f4bb100a7d24'),
(501, '::1', '2020-08-30 11:14:46', '5f4bb1a7a433b'),
(502, '::1', '2020-08-30 11:03:31', '5f4bb1b3aef10'),
(503, '::1', '2020-08-30 14:20:43', '5f4bdfeb06126'),
(504, '::1', '2020-08-30 18:58:59', '5f4c2113342d7'),
(505, '::1', '2020-08-30 19:01:06', '5f4c218c07b7b'),
(506, '::1', '2020-08-30 19:05:44', '5f4c22a6d258d'),
(507, '::1', '2020-08-30 19:06:03', '5f4c22cb94da3'),
(508, '::1', '2020-08-30 19:06:03', '5f4c22cbbce91'),
(509, '::1', '2020-08-30 19:06:47', '5f4c22f71d9f4'),
(510, '::1', '2020-08-30 19:35:31', '5f4c299c9bb7f'),
(511, '::1', '2020-09-02 18:22:46', '5f500d11353b5'),
(512, '::1', '2020-09-02 18:24:02', '5f500d7121305'),
(513, '::1', '2020-09-02 18:32:19', '5f500dc9e467e'),
(514, '::1', '2020-09-02 18:32:36', '5f500f74ce09e'),
(515, '::1', '2020-09-13 17:55:01', '5f5e2939a311c'),
(516, '::1', '2020-09-16 19:36:13', '5f629211ae6b0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.pedidos`
--

CREATE TABLE `tb_admin.pedidos` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(255) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.pedidos`
--

INSERT INTO `tb_admin.pedidos` (`id`, `reference_id`, `produto_id`, `amount`, `status`) VALUES
(5, '5e4ec124493bf', 18, 10, 'pendente'),
(6, '5e4ec124493bf', 17, 8, 'pendente'),
(7, '5e4f3b70a86cb', 18, 4, 'pendente'),
(8, '5e4f3b70a86cb', 17, 1, 'pendente'),
(9, '5e4f3baec2452', 18, 2, 'pendente'),
(10, '5e4f3baec2452', 17, 1, 'pendente'),
(11, '5e4f3c3e45570', 18, 1, 'pendente'),
(12, '5e4f3c3e45570', 17, 1, 'pendente'),
(13, '5e55433990d95', 18, 0, 'pendente'),
(14, '5e55437a3b902', 17, 1, 'pendente'),
(15, '5e56d9a4404d0', 18, 1, 'pendente'),
(16, '5e56d9a4404d0', 17, 1, 'pendente'),
(17, '5e56fa91859da', 18, 1, 'pendente'),
(18, '5e56fcff0abee', 18, 1, 'pendente'),
(19, '5e5801c160d59', 18, 1, 'pendente'),
(20, '5e594831b3289', 18, 1, 'pendente'),
(21, '5e5948b706eaf', 18, 1, 'pendente'),
(22, '5e5948d6d5262', 18, 1, 'pendente'),
(23, '5e5948f9a301f', 18, 1, 'pendente'),
(24, '5e5e8897244e7', 18, 1, 'pendente'),
(25, '5e5e88dc9affd', 18, 1, 'pendente'),
(26, '5e5e890b813f6', 18, 1, 'pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.subcategoria`
--

CREATE TABLE `tb_admin.subcategoria` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.subcategoria`
--

INSERT INTO `tb_admin.subcategoria` (`id`, `categoria_id`, `subcategoria`, `order_id`) VALUES
(1, 1, 'pulseira', 1),
(2, 1, 'relógio', 2),
(3, 1, 'corrente', 3),
(4, 2, 'blusa', 4),
(5, 2, 'short jeans', 5),
(6, 2, 'bermuda', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2019-12-30'),
(2, '::1', '2019-12-30'),
(3, '::1', '2019-12-31'),
(4, '::1', '2020-01-03'),
(5, '::1', '2020-01-04'),
(6, '::1', '2020-01-05'),
(7, '::1', '2020-01-08'),
(8, '::1', '2020-01-08'),
(9, '::1', '2020-01-09'),
(10, '::1', '2020-01-11'),
(11, '127.0.0.1', '2020-01-16'),
(12, '::1', '2020-01-18'),
(13, '::1', '2020-01-19'),
(14, '::1', '2020-01-25'),
(15, '::1', '2020-01-25'),
(16, '::1', '2020-01-26'),
(17, '::1', '2020-01-29'),
(18, '::1', '2020-01-29'),
(19, '::1', '2020-02-02'),
(20, '::1', '2020-02-03'),
(21, '::1', '2020-02-04'),
(22, '::1', '2020-02-05'),
(23, '::1', '2020-02-08'),
(24, '::1', '2020-02-09'),
(25, '::1', '2020-02-12'),
(26, '::1', '2020-02-13'),
(27, '::1', '2020-02-13'),
(28, '::1', '2020-02-14'),
(29, '::1', '2020-02-15'),
(30, '::1', '2020-02-16'),
(31, '::1', '2020-02-17'),
(32, '::1', '2020-02-18'),
(33, '::1', '2020-02-19'),
(34, '::1', '2020-02-19'),
(35, '::1', '2020-02-20'),
(36, '::1', '2020-02-21'),
(37, '::1', '2020-02-21'),
(38, '::1', '2020-02-25'),
(39, '::1', '2020-02-25'),
(40, '::1', '2020-02-26'),
(41, '::1', '2020-02-28'),
(42, '::1', '2020-02-29'),
(43, '::1', '2020-03-01'),
(44, '::1', '2020-03-03'),
(45, '::1', '2020-03-03'),
(46, '127.0.0.1', '2020-03-17'),
(47, '::1', '2020-04-01'),
(48, '::1', '2020-04-10'),
(49, '::1', '2020-04-21'),
(50, '::1', '2020-04-22'),
(51, '::1', '2020-04-23'),
(52, '::1', '2020-04-28'),
(53, '::1', '2020-05-11'),
(54, '::1', '2020-05-12'),
(55, '::1', '2020-05-28'),
(56, '::1', '2020-06-05'),
(57, '::1', '2020-06-08'),
(58, '::1', '2020-06-12'),
(59, '::1', '2020-06-12'),
(60, '::1', '2020-06-12'),
(61, '::1', '2020-06-12'),
(62, '::1', '2020-06-17'),
(63, '::1', '2020-06-17'),
(64, '::1', '2020-06-17'),
(65, '::1', '2020-06-17'),
(66, '::1', '2020-06-17'),
(67, '::1', '2020-06-19'),
(68, '127.0.0.1', '2020-06-20'),
(69, '::1', '2020-06-21'),
(70, '::1', '2020-06-21'),
(71, '::1', '2020-06-24'),
(72, '::1', '2020-06-25'),
(73, '::1', '2020-06-26'),
(74, '::1', '2020-06-26'),
(75, '::1', '2020-07-04'),
(76, '::1', '2020-07-06'),
(77, '::1', '2020-07-12'),
(78, '::1', '2020-07-13'),
(79, '::1', '2020-07-14'),
(80, '::1', '2020-07-15'),
(81, '::1', '2020-07-19'),
(82, '::1', '2020-07-19'),
(83, '::1', '2020-07-19'),
(84, '::1', '2020-07-19'),
(85, '::1', '2020-07-21'),
(86, '::1', '2020-08-01'),
(87, '::1', '2020-08-02'),
(88, '::1', '2020-08-08'),
(89, '::1', '2020-08-09'),
(90, '::1', '2020-08-09'),
(91, '::1', '2020-08-14'),
(92, '::1', '2020-08-19'),
(93, '::1', '2020-08-19'),
(94, '::1', '2020-08-23'),
(95, '::1', '2020-08-26'),
(96, '::1', '2020-08-26'),
(97, '::1', '2020-08-28'),
(98, '::1', '2020-08-28'),
(99, '::1', '2020-08-28'),
(100, '::1', '2020-08-28'),
(101, '::1', '2020-08-30'),
(102, '::1', '2020-08-30'),
(103, '::1', '2020-08-30'),
(104, '::1', '2020-09-02'),
(105, '::1', '2020-09-02'),
(106, '::1', '2020-09-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_link.pedido`
--

CREATE TABLE `tb_link.pedido` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_link.pedido`
--

INSERT INTO `tb_link.pedido` (`id`, `link`, `pedido_id`, `loja_id`, `order_id`) VALUES
(2, 'https://www.youtube.com/results?search_query=galeria+via+ajax', 2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.comentarios`
--

CREATE TABLE `tb_site.comentarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `comentario` text NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.comentarios`
--

INSERT INTO `tb_site.comentarios` (`id`, `nome`, `comentario`, `noticia_id`, `loja_id`) VALUES
(1, 'rubens', 'Teste de comentario', 3, 1),
(3, 'rubens', 'Teste de script', 4, 2),
(5, 'rubens', 'segunto teste de comentario', 4, 2),
(13, 'rubens', 'As respostas não aparece', 4, 2),
(14, 'rubens', 'As respostas não aparece', 4, 2),
(15, 'rubens', 'olá esse teste esta funcionado sim ', 8, 2),
(16, 'Caique', 'legal essa postagem', 3, 1),
(17, 'Caique', 'esta tudo ok com o teste ', 5, 1),
(18, 'Rubens', 'ok', 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.descricao`
--

CREATE TABLE `tb_site.descricao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.descricao`
--

INSERT INTO `tb_site.descricao` (`id`, `descricao`, `order_id`) VALUES
(1, 'É uma plataforma onde as Lojas vendem os seus produtos de uma forma diferente, aqui elas mostrar tudo sobre a sua empresa para levar o maximo de segurança para os consumidores', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias`
--

CREATE TABLE `tb_site.noticias` (
  `id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.noticias`
--

INSERT INTO `tb_site.noticias` (`id`, `loja_id`, `data`, `titulo`, `conteudo`, `capa`, `slug`, `order_id`) VALUES
(3, 1, '2020-02-04', 'ssssssssss', '<p><strong>Lorem Ipsum</strong> &eacute; simplesmente uma simula&ccedil;&atilde;o de texto da ind&uacute;stria tipogr&aacute;fica e de impressos, e vem sendo utilizado desde o s&eacute;culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu n&atilde;o s&oacute; a cinco s&eacute;culos, como tamb&eacute;m ao salto para a editora&ccedil;&atilde;o eletr&ocirc;nica, permanecendo essencialmente inalterado. Se popularizou na d&eacute;cada de 60, quando a Letraset lan&ccedil;ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editora&ccedil;&atilde;o eletr&ocirc;nica como Aldus PageMaker.</p>\r\n<p><img class=\"n3VNCb\" style=\"width: 525px; height: 330.221px; margin: 0px auto; display: block;\" src=\"https://i.redd.it/9ej6sch5ip431.jpg\" alt=\"Image result for 1982\" data-noaft=\"1\" /></p>\r\n<p>Vestibulum turpis diam, porta ut tortor pellentesque, aliquet viverra dui. Quisque maximus lacus enim, non laoreet ligula malesuada a. Suspendisse molestie nec ante a mollis. Fusce justo nisi, lacinia quis tincidunt et, eleifend nec eros. Nulla elit risus, posuere eget scelerisque eu, dictum ut nulla. Maecenas consequat tellus turpis, nec vestibulum ligula cursus sit amet. Pellentesque mauris erat, consequat sit amet lectus eu, fringilla aliquet libero. Nunc tristique nisl erat, vel elementum felis congue nec. Curabitur vel nisl eu lacus volutpat venenatis ut in elit. Phasellus sed est nec leo tristique fermentum eu id leo. Proin nec maximus arcu. Suspendisse metus sem, cursus sit amet dignissim ut, scelerisque a tellus. Etiam purus felis, vestibulum id consectetur eget, sodales vitae urna. Nunc nec dui eu neque convallis maximus nec sit amet massa. Vestibulum non accumsan libero, eu pellentesque purus.</p>\r\n<p>Mauris fermentum congue nulla ac gravida. Praesent faucibus pellentesque magna eu pellentesque. Vivamus pharetra imperdiet consectetur. Nulla arcu lectus, lobortis nec sapien eget, lobortis auctor diam. Vivamus viverra porta turpis eu blandit. Vestibulum mollis malesuada est, ut pharetra est semper eu. Vestibulum et venenatis ante. Donec malesuada porta sagittis. Suspendisse ullamcorper, nisi rhoncus semper facilisis, ante dui mollis orci, imperdiet consectetur nunc orci vitae velit. Donec congue libero et urna viverra dictum.</p>\r\n<p>Nam ornare purus at dolor lacinia, et congue libero ornare. Nunc suscipit facilisis odio vel condimentum. Nulla massa risus, efficitur id volutpat at, consequat nec dolor. In a pharetra purus, at luctus turpis. Nunc vitae justo bibendum, posuere tellus eget, accumsan lacus. Quisque ac felis in neque accumsan dignissim. Integer volutpat blandit nulla venenatis laoreet. Nam convallis accumsan consectetur. Donec nec dui id ligula venenatis facilisis. Quisque tincidunt nunc neque, vitae pulvinar lacus gravida ut. Nullam at magna a turpis tristique iaculis.</p>', '5e39cbccefbaf.jpg', 'ssssssssss', 5),
(4, 2, '2020-01-30', 'Noticia', '<p>Minha noticia Nova esta atualizada</p>', '5e335a7fe891d.jpg', 'noticia', 4),
(5, 1, '2020-01-31', 'Nova categoria', '<p>teste de uma nova categoria no sistema ok</p>', '5e345e40dce93.jpg', 'nova-categoria', 10),
(8, 2, '2020-02-05', 'testes', '<p>dasdsafdsfds</p>\r\n<p>fdsgd</p>\r\n<p>gdfgdfg</p>\r\n<p>dfgfd</p>\r\n<p>gdfg</p>\r\n<p>dfgfdgdfgdfg</p>', '5e3b41b03f214.jpg', 'testes', 3),
(9, 2, '2020-06-05', 'Novos produtos ', '<p>N&oacute;s teremos produtos em prev&ecirc; na plataforma</p>', '5eda7e2360bb6.jpg', 'novos-produtos-', 8),
(10, 1, '2020-06-05', 'Teste de Venda', '<p>eu irei inicia um novo teste de venda</p>', '5eda81fc95978.jpg', 'teste-de-venda', 11),
(11, 2, '2020-06-05', 'Notebook DELL', '<p>Notebook da DELL novo lan&ccedil;amento da nossa loja</p>', '5eda83f29b908.jpg', 'notebook-dell', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.pedido`
--

CREATE TABLE `tb_site.pedido` (
  `id` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `promocao` double(10,2) NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `tamanho` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.pedido`
--

INSERT INTO `tb_site.pedido` (`id`, `preco`, `promocao`, `quantidade`, `tamanho`, `cor`, `produto_id`, `usuario_id`, `loja_id`) VALUES
(2, '32.00', 22.00, '3', 'P', 'Vermelho', 42, 1, 1),
(5, '32.00', 22.00, '4', 'G', 'Vermelho', 42, 3, 1),
(6, '90.00', 0.00, '3', ' M', ' Branco ', 44, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.resposta_comentarios`
--

CREATE TABLE `tb_site.resposta_comentarios` (
  `id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `resposta` text NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.resposta_comentarios`
--

INSERT INTO `tb_site.resposta_comentarios` (`id`, `loja_id`, `resposta`, `comentario_id`) VALUES
(1, 1, 'teste concluido', 1),
(2, 1, 'teste concluido', 1),
(3, 1, 'Concluido', 3),
(9, 1, 'perfeito', 1),
(10, 1, 'teste novo', 1),
(11, 3, 'teste', 3),
(76, 2, 'ok', 5),
(77, 2, 'Agora esta funcionando', 14),
(78, 1, '<p>sim</p>', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recover_solicitado`
--
ALTER TABLE `recover_solicitado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recover_solicitado_empresa`
--
ALTER TABLE `recover_solicitado_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.categoria`
--
ALTER TABLE `tb_admin.categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.colaborado`
--
ALTER TABLE `tb_admin.colaborado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.consumido`
--
ALTER TABLE `tb_admin.consumido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.estoque`
--
ALTER TABLE `tb_admin.estoque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.estoque_imagens`
--
ALTER TABLE `tb_admin.estoque_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.financeiro`
--
ALTER TABLE `tb_admin.financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.lojas`
--
ALTER TABLE `tb_admin.lojas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.pedidos`
--
ALTER TABLE `tb_admin.pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.subcategoria`
--
ALTER TABLE `tb_admin.subcategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_link.pedido`
--
ALTER TABLE `tb_link.pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.descricao`
--
ALTER TABLE `tb_site.descricao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.pedido`
--
ALTER TABLE `tb_site.pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.resposta_comentarios`
--
ALTER TABLE `tb_site.resposta_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recover_solicitado`
--
ALTER TABLE `recover_solicitado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recover_solicitado_empresa`
--
ALTER TABLE `recover_solicitado_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_admin.categoria`
--
ALTER TABLE `tb_admin.categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_admin.colaborado`
--
ALTER TABLE `tb_admin.colaborado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_admin.consumido`
--
ALTER TABLE `tb_admin.consumido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_admin.estoque`
--
ALTER TABLE `tb_admin.estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_admin.estoque_imagens`
--
ALTER TABLE `tb_admin.estoque_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tb_admin.financeiro`
--
ALTER TABLE `tb_admin.financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_admin.lojas`
--
ALTER TABLE `tb_admin.lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `tb_admin.pedidos`
--
ALTER TABLE `tb_admin.pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_admin.subcategoria`
--
ALTER TABLE `tb_admin.subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tb_link.pedido`
--
ALTER TABLE `tb_link.pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_site.comentarios`
--
ALTER TABLE `tb_site.comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_site.descricao`
--
ALTER TABLE `tb_site.descricao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_site.pedido`
--
ALTER TABLE `tb_site.pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_site.resposta_comentarios`
--
ALTER TABLE `tb_site.resposta_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
