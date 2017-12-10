-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 06 2017 г., 21:38
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `flower`
--

CREATE TABLE `flower` (
  `id` smallint(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `genus_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flower`
--

INSERT INTO `flower` (`id`, `name`, `description`, `date_create`, `date_update`, `genus_id`) VALUES
(1, 'Первый цветок', 'Первое описание', '2017-12-05 11:24:49', '2017-12-06 01:17:49', 1),
(2, 'Второй цветок', 'Второе описание', '2017-12-05 11:25:43', '2017-12-05 11:25:43', 1),
(3, 'Третий цветок', 'Третье описние', '2017-12-05 11:26:17', '2017-12-05 11:26:22', 2),
(4, 'Второй', '123', '2017-12-06 01:42:31', '2017-12-06 01:42:31', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `flower_image`
--

CREATE TABLE `flower_image` (
  `id` smallint(6) NOT NULL,
  `path` varchar(255) NOT NULL,
  `main_image` tinyint(1) DEFAULT NULL,
  `flower_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flower_image`
--

INSERT INTO `flower_image` (`id`, `path`, `main_image`, `flower_id`) VALUES
(1, 'd1dbf5d072e2aae7ed26835133f0dc40.jpg', 1, 1),
(2, '75721c83555f51fcc05aa29e3f2574fb.jpg', 0, 1),
(3, '6f7119341da7a4ad1e0a18725f0b757b.jpg', 0, 1),
(4, 'ff8afe27c5c0b1a3ee589a2b28b71414.jpg', 0, 3),
(5, '3ce17abe6cd86157bcff1543c2a7b87e.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `genus`
--

CREATE TABLE `genus` (
  `id` smallint(6) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genus`
--

INSERT INTO `genus` (`id`, `name`) VALUES
(1, 'Ахименес'),
(2, 'Фиалки');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `flower`
--
ALTER TABLE `flower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genus_id` (`genus_id`);

--
-- Индексы таблицы `flower_image`
--
ALTER TABLE `flower_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- Индексы таблицы `genus`
--
ALTER TABLE `genus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `flower`
--
ALTER TABLE `flower`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `flower_image`
--
ALTER TABLE `flower_image`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `genus`
--
ALTER TABLE `genus`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `flower`
--
ALTER TABLE `flower`
  ADD CONSTRAINT `flower_ibfk_1` FOREIGN KEY (`genus_id`) REFERENCES `genus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flower_image`
--
ALTER TABLE `flower_image`
  ADD CONSTRAINT `flower_image_ibfk_1` FOREIGN KEY (`flower_id`) REFERENCES `flower` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
