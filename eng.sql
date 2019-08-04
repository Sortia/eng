-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 04 2019 г., 19:29
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.7

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
(282, 'ÐŸÑÑ‚ÑŒ', '5', 0, 16),
(283, '432', '1123', 1, 17),
(284, '312', '123', 1, 17);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `login` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'Sortia', '$2y$10$0uQj.N/dF7lH.AM/S6FGWORo1fkJQXLNpFVnoEvwXwBct/RKbyA5C', 'alex-kiyan.lug@mail.ru'),
(2, 'Sortia', '$2y$10$lqZQh.9DUzKyW7b2S0A64.shkH3n/yoyESKts4vsTR0DuYOjvcdOe', 'alex-kiyan.lug@mail.ru');

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