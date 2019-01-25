-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 26 2018 г., 00:34
-- Версия сервера: 5.7.21-0ubuntu0.16.04.1
-- Версия PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `belong_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `author`, `body`, `belong_to`) VALUES
(1, 'Alexandr', 'My new comment', 5),
(2, 'Alexandr', 'Second comment', 5),
(3, 'Petr', 'Hello, commenter!', 5),
(4, '1', 'rrrsf', 9),
(5, '3', 'asfdaf', 9),
(6, '332', 'addsdfFDFd', 9),
(7, 'Victor', 'co co coment', 6),
(8, 'Petro', 'Com', 6),
(9, 'ccc', 'coment', 13),
(10, '3rrr', 'rrrr', 11),
(11, 'Barak Obama', 'Hello World!', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `discription` text NOT NULL,
  `status` varchar(45) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `discription`, `status`, `created`, `comments`) VALUES
(5, 'Test', 'Teesst', 'TODO', '2018-04-25 17:42:35', 0),
(6, 'Task', 'nask nask nask', 'DOING', '2018-04-25 13:41:30', 0),
(7, 'Tesk', 'task test', 'DONE', '2018-04-25 19:53:37', 0),
(8, 'Super task', 'Super task', 'DONE', '2018-04-25 20:18:14', 0),
(9, 'Tisk', 'tisk is a pressure on belorusian', 'DOING', '2018-04-25 20:18:29', 0),
(10, 'new fucking task', 'despasito', 'TODO', '2018-04-25 18:54:37', NULL),
(11, 'New task', 'you must do something', 'DONE', '2018-04-25 20:10:28', NULL),
(12, '777@777.by', '7777777', 'TODO', '2018-04-25 19:58:00', NULL),
(13, '111', '222222', 'DONE', '2018-04-25 20:22:12', NULL),
(14, '', '', '', '2018-04-25 20:27:27', NULL),
(15, '', '', '', '2018-04-25 20:27:27', NULL),
(16, '', '', '', '2018-04-25 20:27:27', NULL),
(17, '', '', '', '2018-04-25 20:27:27', NULL),
(18, '', '', '', '2018-04-25 20:27:28', NULL),
(19, '', '', '', '2018-04-25 20:27:28', NULL),
(20, '', '', '', '2018-04-25 20:27:28', NULL),
(21, '', '', '', '2018-04-25 20:27:28', NULL),
(22, '', '', '', '2018-04-25 20:27:28', NULL),
(23, '', '', '', '2018-04-25 20:27:28', NULL),
(24, '', '', '', '2018-04-25 20:27:28', NULL),
(25, '', '', '', '2018-04-25 20:27:28', NULL),
(26, '', '', '', '2018-04-25 20:27:28', NULL),
(27, '', '', '', '2018-04-25 20:27:28', NULL),
(28, '', '', '', '2018-04-25 20:27:28', NULL),
(29, '', '', '', '2018-04-25 20:27:28', NULL),
(30, '', '', '', '2018-04-25 20:27:28', NULL),
(31, '', '', '', '2018-04-25 20:27:28', NULL),
(32, '', '', '', '2018-04-25 20:27:28', NULL),
(33, '', '', '', '2018-04-25 20:27:29', NULL),
(34, '', '', '', '2018-04-25 20:27:29', NULL),
(35, '', '', '', '2018-04-25 20:27:29', NULL),
(36, '', '', '', '2018-04-25 20:27:29', NULL),
(37, '', '', '', '2018-04-25 20:27:29', NULL),
(38, '', '', '', '2018-04-25 20:27:29', NULL),
(39, '', '', '', '2018-04-25 20:27:29', NULL),
(40, '', '', '', '2018-04-25 20:27:29', NULL),
(41, '', '', '', '2018-04-25 20:27:29', NULL),
(42, '', '', '', '2018-04-25 20:27:29', NULL),
(43, '', '', '', '2018-04-25 20:27:29', NULL),
(44, '', '', '', '2018-04-25 20:27:29', NULL),
(45, '', '', '', '2018-04-25 20:27:29', NULL),
(46, '', '', '', '2018-04-25 20:27:29', NULL),
(47, '', '', '', '2018-04-25 20:27:29', NULL),
(48, '', '', '', '2018-04-25 20:27:29', NULL),
(49, '', '', '', '2018-04-25 20:27:30', NULL),
(50, '', '', '', '2018-04-25 20:27:30', NULL),
(51, '', '', '', '2018-04-25 20:27:30', NULL),
(52, '', '', '', '2018-04-25 20:27:30', NULL),
(53, '', '', '', '2018-04-25 20:27:30', NULL),
(54, '', '', '', '2018-04-25 20:27:30', NULL),
(55, '', '', '', '2018-04-25 20:27:30', NULL),
(56, '55555', '6666666', 'TODO', '2018-04-25 20:31:28', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
