-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cms
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `new` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Мертвые души','Н.В. Гоголь',0),(2,'Отцы и дети','И.С. Тургенев',1),(3,'Капитанская дочка','А.С. Пушкин',0),(4,'Убить пересмешника','Харпер Ли',1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text,
  `image` varchar(255) NOT NULL DEFAULT 'note.png',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,'Иск по делу о продаже сломанных контроллеров Xbox передан в арбитражный суд','Коллективный иск, в котором утверждалось, что Microsoft намеренно продавала неисправные геймпады для консоли Xbox, передали в арбитражный суд. Корпорация просила об этом ещё в феврале.\n\nИск, поданный в апреле 2020 года американской юридической фирмой CSK&D, сообщает, что большое количество игроков Xbox пострадало от проблем с дрейфующими стиками геймпадов. Фирма также подала аналогичные заявления против Sony и Nintendo. Если Microsoft и правда намеренно продавала сломанные геймпады, то ей грозят серьёзные штрафы.\n\nЭксперты предполагают, что проблема с контроллерами Xbox One вызвана дефектом в конструкции потенциометра — механизма, который переводит давление большого пальца игрока в движение внутри видеоигры.\n\nВ иске утверждается, что этот недостаток был в геймпадах с 2014 года.\n\nВыступая перед Loadout, партнёр CSK& D Бенджамин Джонс назвал переход в арбитраж «концом пути», поскольку теперь дело вряд ли когда-либо будет в публичном суде. При этом другой иск компании о дрейфующих стиках в Joy-Con Nintendo также перенесли в арбитраж ещё в марте 2020 года.','xbox.png','2021-04-20 12:16:05','2021-04-20 12:16:15'),(2,'Facebook запустит подкасты и аудиокомнаты','Источники Vox сообщают, что в ближайшее время Facebook представит новые продукты. Одним из них станет расширенная версия Messenger Rooms с функцией проведения групповых видеозвонков. Помимо этого, появятся аудиокомнаты по типу Clubhouse, где спикеры будут выступать перед своей аудиторией.\n\nНо и это ещё не всё. Пользователи смогут публиковать у себя на страницах голосовые сообщения, а также слушать подкасты в специальном каталоге. Последняя функция разработана в рамках партнёрства с сервисом Spotify.\n\nДата запуска обновлений пока не обозначена.','facebook.jpg','2021-04-20 13:16:20','2021-04-20 13:16:25'),(3,'МТС планирует вложиться в сервис аренды электросамокатов','В ближайшее время МТС может выйти на рынок микромобильного транспорта. Основатели сервиса lite, являющегося дочерним предприятием YouDrive, инициировали переговоры об инвестировании в его развитие. На данный момент сделка находится на этапе обсуждения, и пока что неизвестно, состоится она или нет, узнали «Ведомости» от анонимного источника. МТС интересуется и другими компаниями из этой отрасли.\n\nСервис аренды электросамокатов от YouDrive начал работать в 2018 году. Изначально он был подразделением каршеринга. Но в 2019-м Mail.ru Group купила контроль над YouDrive, а сервис проката остался у основателей и сменил название на lite.\n\nСейчас у него 2 700 электросамокатов. Для сравнения: на долю URent и Whoosh приходится более 60 тысяч самокатов. Сервис работает в Москве и Сочи, занимая примерно 3% рынка. Его выручка в 2020 году превысила 13 млн рублей в год, пишут «Ведомости» со ссылкой на данные из «СПАРК-Интерфакс».','scooter.jpg','2021-04-20 14:16:30','2021-04-20 14:16:36'),(4,'Количество загрузок мобильных приложений выросло на 8,7%','На этой неделе аналитическая компания Sensor Tower опубликовала отчёт за 2021 год. В нём обозначено, что совокупное количество загрузок с App Store и Google Play увеличилось в годовом исчислении на 8,7%.\n\nОсобенно это заметно по отдельной статистике с Google Play — здесь наблюдается прирост на 15,3% по сравнению с первым кварталом 2020-го. А показатель по App Store при этом снизился на 8,6%.\n\nSensor Tower объясняет это «чрезмерным общим количеством, наблюдаемым в первом квартале 2020-го во время начала пандемии COVID-19». Тогда в App Store загрузки увеличились на 35%, а в Google Play — на 38%.\n\nОдной из лучших мобильных игр первого квартала стала King’s Crash Bandicoot: On the Run, которую скачали 23,6 млн человек по всему миру. Тайтл принёс практически 700 тысяч долларов в первую неделю после релиза.\n\nРанее эксперты App Annie сообщили, что мобильные геймеры потратили 22 млрд долларов в App Store и Google Play в начале 2021 года. Самой кассовой игрой в феврале стала PUBG Mobile. Она принесла своими создателям 250 млн долларов за один месяц.','note.png','2021-04-20 15:16:43','2021-04-20 15:16:47');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'nophoto.jpg',
  `about` text,
  `group` int NOT NULL DEFAULT '3',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `subscribed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Вася','11@11.com','$2y$10$B31zIhSrG3ffWtU5rvt7H.OCaC1mPmN7P4Nzu1/Bcnka5vxGjI.M.','39286.jpeg','Я Вася. Просто Вася. Что еще сказать?!',2,'2021-04-19 17:52:10','2021-04-11 07:21:08',1),(2,'Администратор','is.zoom@yandex.ru','$2y$10$VOTQWe83txxg1Nr/MIJ16uAgJCBfamoTER.uY7hTLDSJTXHJ0X.XC','nophoto.jpg','Самый главный на сайте. Можно обращаться по всем вопросам.',1,'2021-04-12 07:21:08','2021-04-12 07:21:08',0),(3,'Пользователь','user@example.com','$2y$10$9W2/PAbH0XKET3ORJx.lauccCjYotT7bgK2hpwk8hzJ0aduV1VZly','nophoto.jpg',NULL,3,'2021-04-13 07:21:08','2021-04-13 07:21:08',0),(4,'NewUser','new@user.com','$2y$10$3IMLiiKEXZRPIadoow7ajOlILxB9EUJXvnGN7lrmmEzIX1ETioqee','nophoto.jpg',NULL,3,'2021-04-14 07:21:08','2021-04-14 07:21:08',0),(6,'Степан Разин','razin@stepan.com','$2y$10$HniP0vMR0bh1Nj5LasgiEONFdYWFODUBbHp/5h0UbSoCc9sCrHF2S','nophoto.jpg',NULL,3,'2021-04-15 07:21:08','2021-04-15 07:21:08',0),(7,'Иван Петрович Павлов','22@22.com','$2y$10$xsVuFkvagXPNj00zWblt9eKhAxGIursOUlR7DIYvDuvDo2R8XWBzK','Ivan_Pavlov.jpg','Иван Павлов - русский и советский учёный, физиолог, вивисектор, создатель науки о высшей нервной деятельности, физиологической школы; лауреат Нобелевской премии по физиологии или медицине 1904 года «за работу по физиологии пищеварения».',3,'2021-04-20 09:06:37','2021-04-15 10:32:00',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-20 18:45:09
