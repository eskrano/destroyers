-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 11 2015 г., 19:11
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `moon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `backpack`
--

CREATE TABLE IF NOT EXISTS `backpack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `up` int(11) NOT NULL,
  `rune` int(11) NOT NULL,
  `aura` int(11) NOT NULL,
  `status` enum('unwear','wear','destroy','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ban`
--

CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `type` enum('mute','permament','block') NOT NULL,
  `text` char(150) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `complects`
--

CREATE TABLE IF NOT EXISTS `complects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `complects`
--

INSERT INTO `complects` (`id`, `name`, `level`, `str`, `def`, `vit`, `cost`) VALUES
(1, 'Комплект ополченца ', 1, 36, 36, 36, 50),
(2, 'Комплект следопыта ', 1, 36, 36, 36, 50),
(3, 'Комплект варвара ', 1, 36, 36, 36, 50),
(4, 'Комплект охотника ', 1, 36, 36, 36, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `access` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL DEFAULT '20',
  `online` int(11) NOT NULL,
  `gold` int(11) NOT NULL DEFAULT '25',
  `silver` int(11) NOT NULL DEFAULT '35',
  `str` int(11) NOT NULL DEFAULT '39',
  `hp` int(11) NOT NULL DEFAULT '39',
  `def` int(11) NOT NULL DEFAULT '39',
  `crystal` int(11) NOT NULL,
  `lair_part` int(11) NOT NULL,
  `lair_stage` int(11) NOT NULL,
  `lair_fights` int(11) NOT NULL,
  `lair_time` int(11) NOT NULL,
  `t_str` int(11) NOT NULL,
  `t_hp` int(11) NOT NULL,
  `t_def` int(11) NOT NULL,
  `save` enum('0','1') NOT NULL DEFAULT '0',
  `sex` enum('0','1') NOT NULL DEFAULT '0',
  `mail` varchar(50) NOT NULL,
  `wear` int(11) NOT NULL,
  `backpack` int(11) NOT NULL DEFAULT '20',
  `fights` int(11) NOT NULL DEFAULT '15',
  `fights_reset` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
