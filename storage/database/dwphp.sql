-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 14-Jan-2018 às 00:00
-- Versão do servidor: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 7.0.4-7+deb.sury.org~trusty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dwphp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pharagraf`
--

CREATE TABLE `pharagraf` (
  `id` int(10) NOT NULL,
  `id_title` int(10) NOT NULL,
  `description` text NOT NULL COMMENT 'text for explanation',
  `code` text COMMENT 'code for view',
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pharagraf`
--

INSERT INTO `pharagraf` (`id`, `id_title`, `description`, `code`, `active`) VALUES
(1, 1, '1 - Para iniciar é necessário acessar o diretório aonde deseja descarregar os arquivos e executar o comando:\n\n', 'curl -LOk http://dwphp.dezwork.com.br/dwphp.zip && unzip dwphp.zip && rm dwphp.zip\r\n', 1),
(2, 1, '2 - Em seguida acesse o arquivo /app/app_config.yml e adicione os dados para conexão com o seu bando de dados em db_development e endereço do desenvolvimento local em address_uri:\r\n\r\n', '## configurações de controle da url\r\ndefault:\r\n development:\r\n  address_uri: 192.168.33.101/meu-site/\r\n  use_https: Off\r\n  use_www: Off\r\n\r\n # configurações do banco de dados\r\n db_development:\r\n  drive: pdo_mysql\r\n  host: localhost\r\n  username: root\r\n  password: suasenha\r\n  database: nomedabase\r\n  encoding: utf8', 1),
(3, 1, '3 - Então basta acessar o endereço informado no address_uri para que o framework incorpore novos arquivos e realize o descarregamento de novas dependências.\r\n\r\n', NULL, 1),
(4, 2, 'Principais comandos para executar apartir do Framework DWPHP:\n<br/>\n- Para executar a atualização ou instalação do composer basta executar o comando:', 'php ./dwphp/console composer\r\n', 1),
(5, 2, '- Para gerar as classes em php conforme esquema do banco de dados: \r\n<br/>\r\nPS:os arquivos serão criados dentro do diretório /app/entity', 'php ./dwphp/console doctrine create-class\r\n', 1),
(7, 2, '- Para atualizar o banco de dados conforme estrutura das classes que estão no diretório /app/entity:\r\n\r\n', 'php ./dwphp/console doctrine orm:schema-tool:update --complete --force\r\n', 1),
(8, 2, '- Para executar os testes unitários do PhpUnit que estão dentro de app/development/tests:\r\n\r\n', './vendor/bin/phpunit ./app/development/tests/ --colors tests\r\n', 1),
(9, 3, 'A estrurua e organização de diretórios com todos os aquivos inicias:\r\n\r\n', '/app\r\n  /development\r\n    /default   #Para outra aplicação basta duplicar a pasta default\r\n      /controllers\r\n      /helpers\r\n      /views\r\n        /error\r\n        /layout\r\n          /default\r\n            - _init.php\r\n            - fotter.php\r\n            - header.php\r\n            - menu.php\r\n          - template.php\r\n        /pages\r\n          - index.php\r\n    /entity\r\n    /models\r\n    /tests\r\n  - app_config.yml\r\n\r\n/dwphp\r\n  /config\r\n    /bin\r\n    /construction\r\n      - class.errorViewPHP.php\r\n      - Framework.php\r\n      - Init.php\r\n    /shell\r\n      - script.sh\r\n  /storage\r\n    /cache\r\n    /log\r\n      - error_php.log\r\n      - error_db.log\r\n      - laodpage.log\r\n    /database\r\n\r\n/library\r\n  /models\r\n    /AbstractObject.php\r\n  - head.php\r\n  - html.php\r\n  - pagination.php\r\n  - sql.php\r\n  - suystemFunction.php\r\n\r\n/public\r\n  /default    #Para outra aplicação basta duplicar a pasta default\r\n    /assets\r\n      /css\r\n        - bootstrap-grid.min.css\r\n        - bootstrap.min.css\r\n        - style.css\r\n      /fonts\r\n      /images\r\n      /js\r\n        - bootstrap.min.js\r\n        - jquery-3.2.1.slim.js\r\n        - main.js\r\n        - popper.min.js\r\n      /vendor\r\n  /uploads\r\n    /tmp\r\n  - .htaccess\r\n  - deploy.php\r\n  - favicon.ico\r\n  - index.php\r\n\r\n/vendor #Diretório do composer\r\n- .gitignore\r\n- .htaccess\r\n- bitbucket-pipeline.yml\r\n- composer.json\r\n- config.yml\r\n- README.md\r\n- start.php', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `title`
--

CREATE TABLE `title` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `title`
--

INSERT INTO `title` (`id`, `title`, `active`) VALUES
(1, 'Primeiros passos', 1),
(2, 'Comandos', 1),
(3, 'Estrutura', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pharagraf`
--
ALTER TABLE `pharagraf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_title` (`id_title`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pharagraf`
--
ALTER TABLE `pharagraf`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pharagraf`
--
ALTER TABLE `pharagraf`
  ADD CONSTRAINT `pharagraf_ibfk_1` FOREIGN KEY (`id_title`) REFERENCES `title` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
