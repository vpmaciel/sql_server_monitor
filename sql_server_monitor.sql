-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jan-2019 às 04:03
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cebusca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_vaga`
--

CREATE TABLE `candidato_vaga` (
  `publicacao_vaga` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `candidato_vaga`
--

INSERT INTO `candidato_vaga` (`publicacao_vaga`, `usuario`, `empresa`) VALUES
(7, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristica_pesssoal`
--

CREATE TABLE `caracteristica_pesssoal` (
  `usuario` int(11) NOT NULL,
  `simpatico` tinyint(1) NOT NULL,
  `cuidadoso` tinyint(1) NOT NULL,
  `preocupado` tinyint(1) NOT NULL,
  `inquieto` tinyint(1) NOT NULL,
  `estavel` tinyint(1) NOT NULL,
  `despretensioso` tinyint(1) NOT NULL,
  `bem_humorado` tinyint(1) NOT NULL,
  `incerto` tinyint(1) NOT NULL,
  `exigente` tinyint(1) NOT NULL,
  `interessado` tinyint(1) NOT NULL,
  `dependente` tinyint(1) NOT NULL,
  `pacifico` tinyint(1) NOT NULL,
  `articulado` tinyint(1) NOT NULL,
  `previsivel` tinyint(1) NOT NULL,
  `seguro` tinyint(1) NOT NULL,
  `dedicado` tinyint(1) NOT NULL,
  `persuasivo` tinyint(1) NOT NULL,
  `encantador` tinyint(1) NOT NULL,
  `teimoso` tinyint(1) NOT NULL,
  `competitivo` tinyint(1) NOT NULL,
  `maleavel` tinyint(1) NOT NULL,
  `obediente` tinyint(1) NOT NULL,
  `introspectivo` tinyint(1) NOT NULL,
  `perfeccionista` tinyint(1) NOT NULL,
  `precavido` tinyint(1) NOT NULL,
  `pratico` tinyint(1) NOT NULL,
  `impulsivo` tinyint(1) NOT NULL,
  `sem_limites` tinyint(1) NOT NULL,
  `indiferente` tinyint(1) NOT NULL,
  `agil` tinyint(1) NOT NULL,
  `sociavel` tinyint(1) NOT NULL,
  `carismatico` tinyint(1) NOT NULL,
  `passivo` tinyint(1) NOT NULL,
  `ousado` tinyint(1) NOT NULL,
  `independente` tinyint(1) NOT NULL,
  `cauteloso` tinyint(1) NOT NULL,
  `convincente` tinyint(1) NOT NULL,
  `alegre` tinyint(1) NOT NULL,
  `destemido` tinyint(1) NOT NULL,
  `mente_aberta` tinyint(1) NOT NULL,
  `inspirador` tinyint(1) NOT NULL,
  `firme` tinyint(1) NOT NULL,
  `preciso` tinyint(1) NOT NULL,
  `desprendido` tinyint(1) NOT NULL,
  `obstinado` tinyint(1) NOT NULL,
  `calmo` tinyint(1) NOT NULL,
  `leal` tinyint(1) NOT NULL,
  `amavel` tinyint(1) NOT NULL,
  `contido` tinyint(1) NOT NULL,
  `empolgado` tinyint(1) NOT NULL,
  `compreensivo` tinyint(1) NOT NULL,
  `extrovertido` tinyint(1) NOT NULL,
  `prevenido` tinyint(1) NOT NULL,
  `versatil` tinyint(1) NOT NULL,
  `energico` tinyint(1) NOT NULL,
  `persistente` tinyint(1) NOT NULL,
  `desligado` tinyint(1) NOT NULL,
  `divertido` tinyint(1) NOT NULL,
  `objetivo` tinyint(1) NOT NULL,
  `assume_riscos_calculados` tinyint(1) NOT NULL,
  `disciplinado` tinyint(1) NOT NULL,
  `meticuloso` tinyint(1) NOT NULL,
  `ponderado` tinyint(1) NOT NULL,
  `observador` tinyint(1) NOT NULL,
  `ansioso` tinyint(1) NOT NULL,
  `analitico` tinyint(1) NOT NULL,
  `animado` tinyint(1) NOT NULL,
  `discreto` tinyint(1) NOT NULL,
  `original` tinyint(1) NOT NULL,
  `conciliador` tinyint(1) NOT NULL,
  `liberal` tinyint(1) NOT NULL,
  `sarcastico` tinyint(1) NOT NULL,
  `pessimista` tinyint(1) NOT NULL,
  `rebelde` tinyint(1) NOT NULL,
  `diplomatico` tinyint(1) NOT NULL,
  `direto` tinyint(1) NOT NULL,
  `atencioso` tinyint(1) NOT NULL,
  `dominador` tinyint(1) NOT NULL,
  `receoso` tinyint(1) NOT NULL,
  `respeitoso` tinyint(1) NOT NULL,
  `descrente` tinyint(1) NOT NULL,
  `agitado` tinyint(1) NOT NULL,
  `influente` tinyint(1) NOT NULL,
  `disponivel` tinyint(1) NOT NULL,
  `expansivo` tinyint(1) NOT NULL,
  `convencional` tinyint(1) NOT NULL,
  `paciente` tinyint(1) NOT NULL,
  `aventureiro` tinyint(1) NOT NULL,
  `decidido` tinyint(1) NOT NULL,
  `realista` tinyint(1) NOT NULL,
  `expressivo` tinyint(1) NOT NULL,
  `determinado` tinyint(1) NOT NULL,
  `fechado` tinyint(1) NOT NULL,
  `autoconfiante` tinyint(1) NOT NULL,
  `sensato` tinyint(1) NOT NULL,
  `adequado` tinyint(1) NOT NULL,
  `espontaneo` tinyint(1) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `desconfiado` tinyint(1) NOT NULL,
  `livre` tinyint(1) NOT NULL,
  `justo` tinyint(1) NOT NULL,
  `desencanado` tinyint(1) NOT NULL,
  `logico` tinyint(1) NOT NULL,
  `apatico` tinyint(1) NOT NULL,
  `reservado` tinyint(1) NOT NULL,
  `humilde` tinyint(1) NOT NULL,
  `egocentrico` tinyint(1) NOT NULL,
  `sistematico` tinyint(1) NOT NULL,
  `gosta_de_se_arriscar` tinyint(1) NOT NULL,
  `sereno` tinyint(1) NOT NULL,
  `cortes` tinyint(1) NOT NULL,
  `serio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificado`
--

CREATE TABLE `certificado` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `instituicao` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `carga_horaria` smallint(6) NOT NULL,
  `ano_conclusao` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `certificado`
--

INSERT INTO `certificado` (`id`, `usuario`, `instituicao`, `curso`, `carga_horaria`, `ano_conclusao`) VALUES
(1, 2, 'CONEXÃO INFORMÁTICA', 'WINDOWS 98, WORD 2000, EXCEL 2000', 50, 2000),
(7, 2, 'FUNDAÇÃO ESTUDAR', 'LIDERANÇA', 16, 2018),
(8, 2, 'SINDICATO DOS METALÚRGICOS DE OURO BRANCO', 'DATILOGRAFIA', 40, 1999);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `instituicao` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `ano_inicio` year(4) NOT NULL,
  `ano_conclusao` year(4) NOT NULL,
  `situacao` tinyint(1) NOT NULL,
  `modalidade` tinyint(1) NOT NULL,
  `nivel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `usuario`, `instituicao`, `curso`, `ano_inicio`, `ano_conclusao`, `situacao`, `modalidade`, `nivel`) VALUES
(1, 2, 'UNIPAC', 'ENGENHARIA DA COMPUTAÇÃO', 2004, 2008, 1, 2, 5),
(2, 1, 'IFMG', 'SISTEMAS DE INFORMAÇÃO', 2018, 2021, 0, 0, 0),
(3, 2, 'IFMG', 'SISTEMAS DE INFORMAÇÃO', 2018, 2021, 2, 2, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `data_criacao` char(10) NOT NULL,
  `data_ultimo_acesso` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `razao_social`, `email`, `senha`, `data_criacao`, `data_ultimo_acesso`) VALUES
(1, 'GERDAU', 'gerdau@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `experiencia_profissional`
--

CREATE TABLE `experiencia_profissional` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `data_admissao` char(10) NOT NULL,
  `data_saida` char(10) NOT NULL,
  `nivel_hierarquico` tinyint(1) NOT NULL,
  `funcoes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `experiencia_profissional`
--

INSERT INTO `experiencia_profissional` (`id`, `usuario`, `empresa`, `cargo`, `data_admissao`, `data_saida`, `nivel_hierarquico`, `funcoes`) VALUES
(1, 2, 'ELEB - ELETROMECÂNICA BENFICA LTDA', 'AJUDANTE', '12/02/1981', '12/04/2050', 3, 'CONTROLAR ALMOXARIFADO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `habilidade`
--

CREATE TABLE `habilidade` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `conhecimento` varchar(20) NOT NULL,
  `nivel_conhecimento` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `habilidade`
--

INSERT INTO `habilidade` (`id`, `usuario`, `conhecimento`, `nivel_conhecimento`) VALUES
(1, 2, 'SPRING', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma`
--

CREATE TABLE `idioma` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `idioma` varchar(20) NOT NULL,
  `nivel_conhecimento` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `idioma`
--

INSERT INTO `idioma` (`id`, `usuario`, `idioma`, `nivel_conhecimento`) VALUES
(1, 2, 'ESPANHOL', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `objetivo_profissional`
--

CREATE TABLE `objetivo_profissional` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `pretensao_salarial` tinyint(1) NOT NULL,
  `nivel_hierarquico` tinyint(1) NOT NULL,
  `area_interesse` smallint(1) NOT NULL,
  `contrato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `objetivo_profissional`
--

INSERT INTO `objetivo_profissional` (`id`, `usuario`, `cargo`, `pretensao_salarial`, `nivel_hierarquico`, `area_interesse`, `contrato`) VALUES
(2, 2, 'CEO', 15, 1, 2, 1),
(3, 2, 'ARQUITETO DE SOFTWARE', 12, 1, 64, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ultimo_salario` tinyint(1) NOT NULL,
  `data_nascimento` char(10) NOT NULL,
  `idade` tinyint(1) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `estado_civil` tinyint(1) NOT NULL,
  `nacionalidade` tinyint(1) NOT NULL,
  `fone_residencial_codigo_area` char(2) NOT NULL,
  `fone_residencial_numero` varchar(9) NOT NULL,
  `celular_codigo_area` char(2) NOT NULL,
  `celular_numero` varchar(9) NOT NULL,
  `pais` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `cep` char(9) NOT NULL,
  `possui_filhos` tinyint(1) NOT NULL,
  `possui_deficiencia` tinyint(1) NOT NULL,
  `escolaridade` tinyint(1) NOT NULL,
  `cnh` tinyint(1) NOT NULL,
  `empregado_atualmente` tinyint(1) NOT NULL,
  `disponivel_viagens` tinyint(1) NOT NULL,
  `trabalha_outras_cidades` tinyint(1) NOT NULL,
  `trabalha_exterior` tinyint(1) NOT NULL,
  `possui_carro` tinyint(1) NOT NULL,
  `possui_moto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`usuario`, `nome`, `ultimo_salario`, `data_nascimento`, `idade`, `sexo`, `estado_civil`, `nacionalidade`, `fone_residencial_codigo_area`, `fone_residencial_numero`, `celular_codigo_area`, `celular_numero`, `pais`, `estado`, `cidade`, `bairro`, `logradouro`, `complemento`, `cep`, `possui_filhos`, `possui_deficiencia`, `escolaridade`, `cnh`, `empregado_atualmente`, `disponivel_viagens`, `trabalha_outras_cidades`, `trabalha_exterior`, `possui_carro`, `possui_moto`) VALUES
(1, 'VICENTE', 127, '0000-00-00', 36, 0, 0, 0, '0', '', '31', '985130783', 0, 0, 'SANTOS', 'CENTRO', 'RUA CARIJÓS, 253', 'CASA', '36420000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'VICENTE PAULO MACIEL', 2, '13/04/1981', 37, 1, 1, 1, '31', '39380393', '31', '985962524', 1, 13, 'OURO BRANCO', 'CENTRO', 'RUA JOÃO CATARINA, 292', 'CASA', '36420-000', 1, 1, 5, 1, 2, 1, 1, 1, 2, 2),
(3, 'ALINE BEATRIZ MACIEL DE ALMEIDA', 0, '0000-00-00', 8, 0, 0, 0, '0', '', '31', '985130783', 0, 0, 'OURO BRANCO', 'CENTRO', 'RUA JOÃO CATARINA, 292', 'CASA', '36420000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publica_vaga`
--

CREATE TABLE `publica_vaga` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `razao_social` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `funcoes` varchar(255) NOT NULL,
  `beneficios` varchar(255) NOT NULL,
  `data_publicacao` char(10) NOT NULL,
  `vagas` int(11) NOT NULL,
  `contrato` tinyint(1) NOT NULL,
  `salario` tinyint(1) NOT NULL,
  `nivel_hierarquico` tinyint(1) NOT NULL,
  `area_interesse` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `cidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `publica_vaga`
--

INSERT INTO `publica_vaga` (`id`, `empresa`, `razao_social`, `cargo`, `funcoes`, `beneficios`, `data_publicacao`, `vagas`, `contrato`, `salario`, `nivel_hierarquico`, `area_interesse`, `estado`, `cidade`) VALUES
(7, 1, 'GERDAU', 'AAAAAA', 'BBBBBBBB', 'CCCCCC', '11/11/2000', 2, 7, 15, 3, 127, 26, 'Z');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `data_criacao` char(10) NOT NULL,
  `data_ultimo_acesso` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`, `data_criacao`, `data_ultimo_acesso`) VALUES
(1, 'paulo@oi.com.br', 'c4ca4238a0b923820dcc509a6f75849b', '01-01-2019', '0000-00-00'),
(2, 'vpmaciel@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '01-01-2019', '12-01-2019'),
(3, 'aline@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '01-01-2019', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidato_vaga`
--
ALTER TABLE `candidato_vaga`
  ADD KEY `fk_candidato_vaga_publicacao_de_vaga` (`publicacao_vaga`);

--
-- Indexes for table `caracteristica_pesssoal`
--
ALTER TABLE `caracteristica_pesssoal`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `experiencia_profissional`
--
ALTER TABLE `experiencia_profissional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `habilidade`
--
ALTER TABLE `habilidade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idioma`
--
ALTER TABLE `idioma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objetivo_profissional`
--
ALTER TABLE `objetivo_profissional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `publica_vaga`
--
ALTER TABLE `publica_vaga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificado`
--
ALTER TABLE `certificado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `experiencia_profissional`
--
ALTER TABLE `experiencia_profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `habilidade`
--
ALTER TABLE `habilidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `idioma`
--
ALTER TABLE `idioma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `objetivo_profissional`
--
ALTER TABLE `objetivo_profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publica_vaga`
--
ALTER TABLE `publica_vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
