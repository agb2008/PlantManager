-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 21 2021 г., 23:14
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `plantmanager`
--
DROP DATABASE IF EXISTS `plantmanager`;
CREATE DATABASE IF NOT EXISTS `plantmanager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `plantmanager`;

-- --------------------------------------------------------

--
-- Структура таблицы `companion`
--

CREATE TABLE `companion` (
  `id` bigint UNSIGNED NOT NULL,
  `species_id` bigint UNSIGNED NOT NULL,
  `companion_id` bigint UNSIGNED NOT NULL,
  `type` bit(1) DEFAULT b'0' COMMENT 'Хорошая совместимость - 1\r\nПлохая совместимость - 0 или любое другое число',
  `description` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Таблица совместимости видов растений. 1 - хорошая совместимость, 0 - плохая совместимость, NULL - не определена';

-- --------------------------------------------------------

--
-- Структура таблицы `family`
--

CREATE TABLE `family` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Таблица определения семейства  растений';

--
-- Дамп данных таблицы `family`
--

INSERT INTO `family` (`id`, `name`, `description`) VALUES
(1, 'Тыквенные', 'Описание семейства тыквенных'),
(2, 'Капустные', 'Описание семейства капустные');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `address` text,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `website` varchar(32) DEFAULT NULL,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Информация о производителе товара';

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `address`, `email`, `phone`, `website`, `notes`) VALUES
(1, 'ООО \"Агрофирма Партнер\"', 'Россия, г. Москва, ул. Ботаническая, д. 35', 'info@semena-partner.ru', '+7(499)677-62-42', 'www.semena-partner.ru', 'Тестовое примечание к карточке агрофирмы Партнер'),
(2, 'ООО \"Агрофирма СеДеК\"', 'Россия, Московская обл., г. Домодедово, мкр-н Востряково, ул. Парковая, д. 19', 'shop@sedek.ru', '+7(495)788-93-90', 'www.sedek.ru', 'Текстовое примечание к карточке агрофирмы СеДеК');

-- --------------------------------------------------------

--
-- Структура таблицы `plants`
--

CREATE TABLE `plants` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'ID рассады',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT 'Название рассады',
  `type_id` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID типа рассады',
  `manufacturer_id` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID производителя',
  `amount` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Кол-во рассады',
  `img_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID картинки для рассады',
  `notes` varchar(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '""' COMMENT 'Заметки',
  `price` double UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Цена за 1 шт.',
  `purchase_date` date DEFAULT NULL COMMENT 'Дата проибретения',
  `plant_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата высадки рассады',
  `seeds_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Если выращено из семян, то указываем id, если приобретена рассада - то NULL',
  `user_id` bigint UNSIGNED NOT NULL COMMENT 'Привязка к id пользователя',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Таблица с информацией о рассаде' ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `plants`
--

INSERT INTO `plants` (`id`, `name`, `type_id`, `manufacturer_id`, `amount`, `img_id`, `notes`, `price`, `purchase_date`, `plant_date`, `seeds_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ласточка F1', 1, 1, 6, 1, 'Описание к рассаде огурцов Ласточка F1', 0, NULL, '2021-05-14 08:19:55', NULL, 0, '2021-05-21 19:26:35', '2021-05-21 19:26:35');

-- --------------------------------------------------------

--
-- Структура таблицы `plant_type`
--

CREATE TABLE `plant_type` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '""',
  `family_id` bigint UNSIGNED DEFAULT NULL,
  `species_id` bigint UNSIGNED DEFAULT NULL,
  `notes` varchar(4096) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Общая информация о растении';

--
-- Дамп данных таблицы `plant_type`
--

INSERT INTO `plant_type` (`id`, `name`, `family_id`, `species_id`, `notes`) VALUES
(1, 'Огурец', 1, 1, 'Примечание к описанию растения Огурец'),
(2, 'Редис', 2, 2, 'Примечание к описанию растения Редис');

-- --------------------------------------------------------

--
-- Структура таблицы `seedling`
--

CREATE TABLE `seedling` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'ID рассады',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT 'Название рассады',
  `type_id` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID типа рассады',
  `manufacturer_id` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID производителя',
  `amount` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Кол-во рассады',
  `img_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID картинки для рассады',
  `notes` varchar(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '""' COMMENT 'Заметки',
  `price` double UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Цена за 1 шт.',
  `purchase_date` date DEFAULT NULL COMMENT 'Дата проибретения',
  `plant_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата высадки рассады',
  `seeds_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Если выращено из семян, то указываем id, если приобретена рассада - то NULL',
  `user_id` bigint UNSIGNED NOT NULL COMMENT 'Привязка к id пользователя',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Таблица с информацией о рассаде';

--
-- Дамп данных таблицы `seedling`
--

INSERT INTO `seedling` (`id`, `name`, `type_id`, `manufacturer_id`, `amount`, `img_id`, `notes`, `price`, `purchase_date`, `plant_date`, `seeds_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ласточка F1', 1, 1, 6, 1, 'Описание к рассаде огурцов Ласточка F1', 0, NULL, '2021-05-14 08:19:55', NULL, 0, '2021-05-21 19:26:35', '2021-05-21 19:26:35');

-- --------------------------------------------------------

--
-- Структура таблицы `seeds`
--

CREATE TABLE `seeds` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'ID семян',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Название',
  `number_of_seeds` int UNSIGNED NOT NULL DEFAULT '5' COMMENT 'Кол-во семян в пакете, по умолчанию 5 шт.',
  `amount` int UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Кол-во пакетиков семян',
  `type_id` bigint UNSIGNED NOT NULL COMMENT 'ID типа семян',
  `manafacturer_id` bigint UNSIGNED NOT NULL COMMENT 'ID производителя семян',
  `production_date` date NOT NULL COMMENT 'Дата выпуска',
  `expiration_date` date NOT NULL COMMENT 'Дата завершения срока годности',
  `harvest_year` date DEFAULT NULL COMMENT 'Год, когда были собраны эти семена',
  `notes` varchar(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '""' COMMENT 'Заметки',
  `price` double UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Цена пакета с семенами',
  `img_id` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID картинки',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint UNSIGNED NOT NULL COMMENT 'ID пользователя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Информация о семенах';

--
-- Дамп данных таблицы `seeds`
--

INSERT INTO `seeds` (`id`, `name`, `number_of_seeds`, `amount`, `type_id`, `manafacturer_id`, `production_date`, `expiration_date`, `harvest_year`, `notes`, `price`, `img_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Ласточка F1', 10, 1, 1, 1, '2020-08-21', '2023-12-31', '2019-09-01', 'Огурец для открытого грунта Ласточка F1.\r\nРаннеспелый, пчелоопыляемый гибрид преимущественно женского типа цветения. От всходов до начала цветения 38-42 дня. Плод цилиндрической формы, крупнобугорчатый, черношипный, без горичи, зеленец длиной 11-12 см., массой 80-110 гр. Вкусовые качества свежих плодов отличные. Рекомендуется для засолки и консервирования. Устойчив к вирусу огуречной мозаики, мучнистой и ложной мучнистой росе. Плотность посадки 5-6 растений на кв. м. Урожайность 10.0 - 12.0 кг / кв. м.', 120, 1, '2021-05-21 19:38:38', '2021-05-21 19:38:38', 0),
(2, 'Суперстар', 50, 1, 2, 2, '2018-11-01', '2018-11-01', '2017-08-25', 'Скороспелый (от всходов до технической спелости 19-21 день) сорт для всесезонного выращивания в открытом и защищенном грунте. Корнеплоды округлые и округло-овальные, гладкие, ярко-красные, массой 20-23 гр. Мякоть белая, плотная, сочная, полуострого вкуса. Ценность сорта: устойчивость к пониженной освещенности и цветушности, дружное формирование урожая, выравненность корнеплодов, пригодность для позднеспелого выращивания в открытом грунте и всесезонного в защищенном. Рекомендуется для использования в свежем виде. Оптимальная для прорастания семян температура почвы 16-20 градусов цельсия.', 0, 0, '2021-05-21 19:38:38', '2021-05-21 19:38:38', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `species`
--

CREATE TABLE `species` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Таблица с описанием вида растений';

--
-- Дамп данных таблицы `species`
--

INSERT INTO `species` (`id`, `name`, `description`) VALUES
(1, 'Огурец обыкновенный', 'Огуре́ц обыкнове́нный, или Огурец посевно́й (лат. Cucumis sativus), — однолетнее травянистое растение, вид рода Огурец (Cucumis) семейства Тыквенные (Cucurbitaceae), овощная культура.'),
(2, 'Редька посевная', 'Редька посевная, или Редька огородная (лат. Raphanus sativus) — однолетнее или двулетнее травянистое растение, вид рода Редька (Raphanus) семейства Капустные (Brassicaceae).');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `companion`
--
ALTER TABLE `companion`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_seedling_plant_type` (`type_id`) USING BTREE,
  ADD KEY `FK_seedling_manufacturer` (`manufacturer_id`) USING BTREE;

--
-- Индексы таблицы `plant_type`
--
ALTER TABLE `plant_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_plant_type_family` (`family_id`),
  ADD KEY `FK_plant_type_species` (`species_id`);

--
-- Индексы таблицы `seedling`
--
ALTER TABLE `seedling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_seedling_plant_type` (`type_id`),
  ADD KEY `FK_seedling_manufacturer` (`manufacturer_id`);

--
-- Индексы таблицы `seeds`
--
ALTER TABLE `seeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_seeds_plant_type` (`type_id`),
  ADD KEY `FK_seeds_manufacturer` (`manafacturer_id`);

--
-- Индексы таблицы `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `companion`
--
ALTER TABLE `companion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `family`
--
ALTER TABLE `family`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID рассады', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `plant_type`
--
ALTER TABLE `plant_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `seedling`
--
ALTER TABLE `seedling`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID рассады', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `seeds`
--
ALTER TABLE `seeds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID семян', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `species`
--
ALTER TABLE `species`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`),
  ADD CONSTRAINT `plants_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `plant_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `plant_type`
--
ALTER TABLE `plant_type`
  ADD CONSTRAINT `FK_plant_type_family` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`),
  ADD CONSTRAINT `FK_plant_type_species` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`);

--
-- Ограничения внешнего ключа таблицы `seedling`
--
ALTER TABLE `seedling`
  ADD CONSTRAINT `FK_seedling_manufacturer` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`),
  ADD CONSTRAINT `FK_seedling_plant_type` FOREIGN KEY (`type_id`) REFERENCES `plant_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `seeds`
--
ALTER TABLE `seeds`
  ADD CONSTRAINT `FK_seeds_manufacturer` FOREIGN KEY (`manafacturer_id`) REFERENCES `manufacturer` (`id`),
  ADD CONSTRAINT `FK_seeds_plant_type` FOREIGN KEY (`type_id`) REFERENCES `plant_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
