-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: mysql
-- Время создания: Авг 08 2019 г., 15:48
-- Версия сервера: 5.7.22
-- Версия PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eng`
--

-- --------------------------------------------------------

--
-- Структура таблицы `flashcards`
--

CREATE TABLE `flashcards` (
                              `id` int(11) NOT NULL,
                              `name` varchar(255) DEFAULT NULL,
                              `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `flashcards`
--

INSERT INTO `flashcards` (`id`, `name`, `status`) VALUES
(16, '1235', 0),
(17, '1234', 1);

--
-- Триггеры `flashcards`
--
DELIMITER $$
CREATE TRIGGER `delete_items` BEFORE DELETE ON `flashcards` FOR EACH ROW DELETE FROM items WHERE flashcard_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_items` AFTER UPDATE ON `flashcards` FOR EACH ROW UPDATE items SET status = NEW.status WHERE flashcard_id = NEW.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
                         `id` int(11) NOT NULL,
                         `rus` varchar(255) DEFAULT NULL,
                         `eng` varchar(255) DEFAULT NULL,
                         `status` tinyint(4) DEFAULT NULL,
                         `flashcard_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `rus`, `eng`, `status`, `flashcard_id`) VALUES
(279, 'ÐžÐ´Ð¸Ð½', '1', 0, 16),
(280, 'Ð”Ð²Ð°', '2', 0, 16),
(281, 'Ð¢Ñ€Ð¸', '3', 0, 16),
(282, 'ÐŸÑÑ‚ÑŒ', '5', 1, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `first_name` varchar(255) DEFAULT NULL,
                         `last_name` varchar(255) DEFAULT NULL,
                         `img` varchar(255) NOT NULL DEFAULT 'default.png',
                         `login` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `img`, `login`, `password`, `email`) VALUES
(1, 'Sasha', 'Kiyan123', '3355245b69b7162154a31c008b4b6f-750-563.jpg', 'Sortia', '$2y$10$wdCOiV6OFvSfLyQxE4rXEOkHSoIZ6yrpSBr5NXqiT72PF10tsM./K', 'alex-kiyan.lug@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `flashcards`
--
ALTER TABLE `flashcards`
    ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
    ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `flashcards`
--
ALTER TABLE `flashcards`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;