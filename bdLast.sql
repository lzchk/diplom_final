-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 14 2022 г., 16:01
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Building`
--

CREATE TABLE `Building` (
  `id` int NOT NULL,
  `number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL COMMENT 'отделения в колледжк',
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'ОИТ'),
(2, 'ОМПТиС'),
(3, 'ОПТиС'),
(4, 'ОЭиФ'),
(5, 'СПО');

-- --------------------------------------------------------

--
-- Структура таблицы `discipline`
--

CREATE TABLE `discipline` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `discipline`
--

INSERT INTO `discipline` (`id`, `name`) VALUES
(1, 'Проект. и разр. веб-прил.'),
(2, 'Оптим. веб-прил.'),
(3, 'Проект. и разр. интерф.');

-- --------------------------------------------------------

--
-- Структура таблицы `discip_has_speciality`
--

CREATE TABLE `discip_has_speciality` (
  `id` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_disc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `discip_has_speciality`
--

INSERT INTO `discip_has_speciality` (`id`, `id_spec`, `id_disc`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `group_number`
--

CREATE TABLE `group_number` (
  `id` int NOT NULL,
  `name` varchar(9) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `group_number`
--

INSERT INTO `group_number` (`id`, `name`) VALUES
(1, '39-03'),
(2, ''),
(3, '39-02');

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE `mark` (
  `id` int NOT NULL,
  `name` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `mark`
--

INSERT INTO `mark` (`id`, `name`) VALUES
(1, '2'),
(2, '3'),
(3, '4'),
(4, '5');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Студент'),
(2, 'Преподаватель');

-- --------------------------------------------------------

--
-- Структура таблицы `Room`
--

CREATE TABLE `Room` (
  `id` int NOT NULL,
  `number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Room`
--

INSERT INTO `Room` (`id`, `number`) VALUES
(1, 207),
(2, 312),
(3, 310);

-- --------------------------------------------------------

--
-- Структура таблицы `Schedule`
--

CREATE TABLE `Schedule` (
  `id` int NOT NULL,
  `discipline_id` int NOT NULL,
  `speciality_id` int NOT NULL,
  `room_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `is_online` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `num_lesson` int NOT NULL,
  `week_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Schedule`
--

INSERT INTO `Schedule` (`id`, `discipline_id`, `speciality_id`, `room_id`, `teacher_id`, `is_online`, `date`, `num_lesson`, `week_id`) VALUES
(2, 1, 1, 1, 1, 'да', '2022-11-10', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `specialty`
--

CREATE TABLE `specialty` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `number_group` varchar(10) NOT NULL,
  `id_department` int NOT NULL COMMENT 'Это спец  код подразделения для вывода расписания по времени'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `specialty`
--

INSERT INTO `specialty` (`id`, `name`, `number_group`, `id_department`) VALUES
(1, 'Разработчик веб и мультимедийных приложений', '39-03', 1),
(2, 'Что-то та учу', '39-02', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Завершено'),
(2, 'Просрочено'),
(3, 'В процессе'),
(4, 'Не сдано');

-- --------------------------------------------------------

--
-- Структура таблицы `Teacher`
--

CREATE TABLE `Teacher` (
  `id` int NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Middle_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Teacher`
--

INSERT INTO `Teacher` (`id`, `Surname`, `Name`, `Middle_name`) VALUES
(1, 'Бережков', 'Андрей', 'Вячеславович'),
(2, 'Дышекова', 'Милана', 'Анзоровна');

-- --------------------------------------------------------

--
-- Структура таблицы `type_work`
--

CREATE TABLE `type_work` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `type_work`
--

INSERT INTO `type_work` (`id`, `name`) VALUES
(1, 'Курсовая работа'),
(2, 'Производственная практика');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_spec` int DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `access_token` varchar(32) DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `id_role`, `id_spec`, `auth_key`, `access_token`, `username`, `password`, `avatar`) VALUES
(1, 1, 1, NULL, NULL, 'Эмилия\nКларк\nВалерьевна', '111', NULL),
(2, NULL, NULL, NULL, NULL, 'Машка', 'admin', NULL),
(3, NULL, NULL, NULL, NULL, '5435', '34534534', NULL),
(4, NULL, NULL, NULL, NULL, '11111', '22222', NULL),
(16, NULL, NULL, NULL, NULL, '11111', 'drecfesdr', NULL),
(17, NULL, NULL, NULL, NULL, '11111', '232323', NULL),
(18, NULL, NULL, NULL, NULL, '222', '222', NULL),
(19, NULL, NULL, NULL, NULL, 'sd', 'sd', NULL),
(20, NULL, NULL, NULL, NULL, 'we', 'we', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_has_group`
--

CREATE TABLE `user_has_group` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_has_group`
--

INSERT INTO `user_has_group` (`id`, `id_user`, `id_group`) VALUES
(1, 1, 1),
(2, 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `week`
--

CREATE TABLE `week` (
  `id` int NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `week`
--

INSERT INTO `week` (`id`, `name`) VALUES
(1, 'Числитель'),
(2, 'Знаменатель');

-- --------------------------------------------------------

--
-- Структура таблицы `work`
--

CREATE TABLE `work` (
  `id` int NOT NULL,
  `id_type_work` int NOT NULL,
  `id_discipline` int NOT NULL,
  `topic` varchar(100) NOT NULL,
  `date_since` date NOT NULL,
  `date_by` date NOT NULL,
  `loading` date NOT NULL,
  `id_mark` int NOT NULL,
  `id_status` int NOT NULL,
  `id_created_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Building`
--
ALTER TABLE `Building`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discip_has_speciality`
--
ALTER TABLE `discip_has_speciality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disc` (`id_disc`),
  ADD KEY `id_spec` (`id_spec`);

--
-- Индексы таблицы `group_number`
--
ALTER TABLE `group_number`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Schedule`
--
ALTER TABLE `Schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `speciality_id` (`speciality_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `schedule_ibfk_1` (`discipline_id`),
  ADD KEY `week_id` (`week_id`);

--
-- Индексы таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialty_ibfk_1` (`id_department`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Teacher`
--
ALTER TABLE `Teacher`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type_work`
--
ALTER TABLE `type_work`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_spec` (`id_spec`);

--
-- Индексы таблицы `user_has_group`
--
ALTER TABLE `user_has_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_typeWork` (`id_type_work`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_discipline` (`id_discipline`),
  ADD KEY `id_marks` (`id_mark`),
  ADD KEY `id_created_by` (`id_created_by`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Building`
--
ALTER TABLE `Building`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'отделения в колледжк', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `discip_has_speciality`
--
ALTER TABLE `discip_has_speciality`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `group_number`
--
ALTER TABLE `group_number`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Room`
--
ALTER TABLE `Room`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Schedule`
--
ALTER TABLE `Schedule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Teacher`
--
ALTER TABLE `Teacher`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `type_work`
--
ALTER TABLE `type_work`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `user_has_group`
--
ALTER TABLE `user_has_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `week`
--
ALTER TABLE `week`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `work`
--
ALTER TABLE `work`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `discip_has_speciality`
--
ALTER TABLE `discip_has_speciality`
  ADD CONSTRAINT `discip_has_speciality_ibfk_1` FOREIGN KEY (`id_disc`) REFERENCES `discipline` (`id`),
  ADD CONSTRAINT `discip_has_speciality_ibfk_2` FOREIGN KEY (`id_spec`) REFERENCES `specialty` (`id`);

--
-- Ограничения внешнего ключа таблицы `Schedule`
--
ALTER TABLE `Schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `Room` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`speciality_id`) REFERENCES `specialty` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `Teacher` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_5` FOREIGN KEY (`week_id`) REFERENCES `week` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD CONSTRAINT `specialty_ibfk_1` FOREIGN KEY (`id_department`) REFERENCES `discipline` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_spec`) REFERENCES `specialty` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_has_group`
--
ALTER TABLE `user_has_group`
  ADD CONSTRAINT `user_has_group_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `group_number` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_has_group_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `work_ibfk_3` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id`),
  ADD CONSTRAINT `work_ibfk_4` FOREIGN KEY (`id_mark`) REFERENCES `mark` (`id`),
  ADD CONSTRAINT `work_ibfk_5` FOREIGN KEY (`id_created_by`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `work_ibfk_6` FOREIGN KEY (`id_type_work`) REFERENCES `type_work` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
