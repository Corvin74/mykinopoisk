-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 16 2020 г., 22:25
-- Версия сервера: 8.0.22-0ubuntu0.20.04.3
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kinopoisk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dic_country`
--

CREATE TABLE `dic_country` (
  `id` int UNSIGNED NOT NULL,
  `country` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dic_country`
--

INSERT INTO `dic_country` (`id`, `country`) VALUES
(1, 'Россия'),
(2, 'США'),
(3, 'СССР'),
(4, 'Австралия'),
(5, 'Австрия'),
(6, 'Азербайджан'),
(7, 'Албания'),
(8, 'Алжир'),
(9, 'Американское Самоа'),
(10, 'Ангола'),
(11, 'Андорра'),
(12, 'Антигуа и Барбуда'),
(13, 'Антильские Острова'),
(14, 'Аргентина'),
(15, 'Армения'),
(16, 'Аруба'),
(17, 'Афганистан'),
(18, 'Багамы'),
(19, 'Бангладеш'),
(20, 'Барбадос'),
(21, 'Бахрейн'),
(22, 'Беларусь'),
(23, 'Белиз'),
(24, 'Бельгия'),
(25, 'Бенин'),
(26, 'Берег Слоновой кости'),
(27, 'Бермуды'),
(28, 'Бирма'),
(29, 'Болгария'),
(30, 'Боливия'),
(31, 'Босния'),
(32, 'Босния и Герцеговина'),
(33, 'Ботсвана'),
(34, 'Бразилия'),
(35, 'Бруней-Даруссалам'),
(36, 'Буркина-Фасо'),
(37, 'Бурунди'),
(38, 'Бутан'),
(39, 'Вануату'),
(40, 'Ватикан'),
(41, 'Великобритания'),
(42, 'Венгрия'),
(43, 'Венесуэла'),
(44, 'Виргинские Острова (Великобритания)'),
(45, 'Виргинские Острова (США)'),
(46, 'Внешние малые острова США'),
(47, 'Вьетнам'),
(48, 'Вьетнам Северный'),
(49, 'Габон'),
(50, 'Гаити'),
(51, 'Гайана'),
(52, 'Гамбия'),
(53, 'Гана');

-- --------------------------------------------------------

--
-- Структура таблицы `dic_genre`
--

CREATE TABLE `dic_genre` (
  `id` int UNSIGNED NOT NULL,
  `genre_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dic_genre`
--

INSERT INTO `dic_genre` (`id`, `genre_name`, `created_at`) VALUES
(1, 'аниме', '2020-12-07 21:00:00'),
(2, 'биография', '2020-12-07 21:00:00'),
(3, 'боевик', '2020-12-07 21:00:00'),
(4, 'вестерн', '2020-12-07 21:00:00'),
(5, 'военный', '2020-12-07 21:00:00'),
(6, 'детектив', '2020-12-07 21:00:00'),
(7, 'детский', '2020-12-07 21:00:00'),
(8, 'для взрослых', '2020-12-07 21:00:00'),
(9, 'документальный', '2020-12-07 21:00:00'),
(10, 'драма', '2020-12-07 21:00:00'),
(11, 'игра', '2020-12-07 21:00:00'),
(12, 'история', '2020-12-07 21:00:00'),
(13, 'комедия', '2020-12-07 21:00:00'),
(14, 'концерт', '2020-12-07 21:00:00'),
(15, 'короткометражка', '2020-12-07 21:00:00'),
(16, 'криминал', '2020-12-07 21:00:00'),
(17, 'мелодрама', '2020-12-07 21:00:00'),
(18, 'музыка', '2020-12-07 21:00:00'),
(19, 'мультфильм', '2020-12-07 21:00:00'),
(20, 'мюзикл', '2020-12-07 21:00:00'),
(21, 'новости', '2020-12-07 21:00:00'),
(22, 'приключения', '2020-12-07 21:00:00'),
(23, 'реальное ТВ', '2020-12-07 21:00:00'),
(24, 'семейный', '2020-12-07 21:00:00'),
(25, 'спорт', '2020-12-07 21:00:00'),
(26, 'ток-шоу', '2020-12-07 21:00:00'),
(27, 'триллер', '2020-12-07 21:00:00'),
(28, 'ужасы', '2020-12-07 21:00:00'),
(29, 'фантастика', '2020-12-07 21:00:00'),
(30, 'фильм-нуар', '2020-12-07 21:00:00'),
(31, 'фэнтези', '2020-12-07 21:00:00'),
(32, 'церемония', '2020-12-07 21:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `premiere` date NOT NULL,
  `country_id` int UNSIGNED NOT NULL,
  `images` varchar(100) DEFAULT NULL,
  `genre_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `title`, `premiere`, `country_id`, `images`, `genre_id`) VALUES
(1, 'Друзья (сериал 1994 – 2004)', '1994-03-04', 2, 'Friends.jpg', 13),
(2, 'Побег из Шоушенка', '1994-06-11', 2, 'TheShawshankRedemption.jpg', 10),
(3, 'Зеленая миля', '1999-11-08', 2, 'TheGreenMile.jpg', 16),
(4, 'Последний танец (мини–сериал 2020 – ...)', '2020-02-15', 2, 'TheLastDance.jpg', 9),
(5, 'Игра престолов (сериал 2011 – 2019)', '2011-09-18', 41, 'GameOfThrones.jpg', 31),
(6, 'Чернобыль (мини–сериал 2019)', '2019-04-26', 41, 'Chernobyl.jpg', 10),
(7, 'Форрест Гамп', '1994-11-17', 2, 'ForrestGump.jpg', 5),
(8, 'Гравити Фолз (сериал 2012 – 2016)', '2012-03-12', 2, 'GravityFalls.jpg', 19),
(9, 'Рик и Морти (сериал 2013 – ...)', '2013-08-10', 2, 'RickAndMorty.jpg', 19),
(10, 'Во все тяжкие (сериал 2008 – 2013)', '2008-01-16', 2, 'BreakingBad.jpg', 27),
(11, 'Вавилон 5 (сериал 1993 – 1998)', '1993-02-22', 2, 'babylon5.webp', 29);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dic_country`
--
ALTER TABLE `dic_country`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dic_genre`
--
ALTER TABLE `dic_genre`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country_id`),
  ADD KEY `genre_name` (`genre_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dic_country`
--
ALTER TABLE `dic_country`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `dic_genre`
--
ALTER TABLE `dic_genre`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `country` FOREIGN KEY (`country_id`) REFERENCES `dic_country` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `genre_name` FOREIGN KEY (`genre_id`) REFERENCES `dic_genre` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
