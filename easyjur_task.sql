-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Set-2022 às 21:34
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `easyjur_task`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL COMMENT 'Chave Primaria',
  `user_id` int(11) NOT NULL COMMENT 'Chave Estrangeira',
  `task_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Titulo tarefa',
  `task_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descrição Tarefa',
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status Tarefa',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Criação tarefa',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data atualização tarefa',
  `date_conclusion` timestamp NULL DEFAULT NULL COMMENT 'Data de conclusao tarefa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tarefas';

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `task_name`, `task_description`, `status`, `create_at`, `update_at`, `date_conclusion`) VALUES
(1, 1, 'Lista de Compras Supermercado', 'Arroz - 1pct;\r\nFeijão - 1pct;\r\nÓleo de soja - 1 L;\r\nSal - 1pct;\r\nAçúcar - 1pct;\r\nCafé - 1pct;\r\nMolho de tomate - 1pct;\r\nMacarrão - 1pct;\r\nMilho - 1pct;', 'concluido', '2022-09-11 19:33:09', '2022-09-11 19:33:09', '2022-09-11 19:33:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'Chave Primaria',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nome',
  `cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Cpf',
  `telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Telefone',
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Usuario',
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Senha',
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-mail',
  `admin` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'admin/sim/nao',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data_criacao',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data_atualizacao'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `cpf`, `telefone`, `login`, `senha`, `email`, `admin`, `created_at`, `update_at`) VALUES
(1, 'Bruno Pereira de Andrade Felipe', '13913519670', '34998888299', 'bruno', '$2y$10$qbO2dMdC/dtk/O6qn.T1buaqBHeUm6Wm.hU./6irCIOV2Buqy1lby', 'brunopandradefelipe@gmail.com', 'nao', '2022-09-11 19:31:17', '2022-09-11 19:31:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `foreing_key_users` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primaria', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primaria', AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `foreing_key_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
