-- --------------------------------------------------------
-- 主機:                           220.133.91.144
-- 伺服器版本:                        8.0.33 - MySQL Community Server - GPL
-- 伺服器作業系統:                      Linux
-- HeidiSQL 版本:                  12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- 傾印 final 的資料庫結構
CREATE DATABASE IF NOT EXISTS `final` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `final`;

-- 傾印  資料表 final.ratings 結構
CREATE TABLE IF NOT EXISTS `ratings` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  `menu_item_id` int NOT NULL,
  `restaurant_rating` int NOT NULL,
  `menu_item_rating` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_id` (`restaurant_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`),
  CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在傾印表格  final.ratings 的資料：~35 rows (近似值)
INSERT INTO `ratings` (`rating_id`, `user_id`, `restaurant_id`, `menu_item_id`, `restaurant_rating`, `menu_item_rating`, `comment`, `created_at`) VALUES
	(76, 36, 90, 59, 4, 5, '菜色不錯，服務很親切。', '2023-05-13 12:30:00'),
	(77, 37, 91, 60, 3, 4, '價格有點高，但味道還可以。', '2023-05-13 13:15:00'),
	(78, 38, 92, 61, 5, 5, '非常好吃的湯品，溫暖心靈。', '2023-05-13 14:00:00'),
	(79, 39, 93, 62, 4, 4, '快速送達，食物還熱呢。', '2023-05-13 14:45:00'),
	(80, 40, 94, 63, 5, 5, '新鮮的海鮮，非常美味。', '2023-05-13 15:30:00'),
	(81, 41, 95, 64, 3, 3, '份量太少，不太飽足。', '2023-05-13 16:15:00'),
	(82, 42, 96, 65, 4, 4, '菜色多樣，適合全家人。', '2023-05-13 17:00:00'),
	(83, 43, 97, 66, 5, 5, '非常滿意的用餐體驗，推薦！', '2023-05-13 17:45:00'),
	(84, 44, 98, 67, 3, 3, '服務有待改進，菜品還可以。', '2023-05-13 18:30:00'),
	(85, 45, 99, 68, 4, 4, '交通方便，環境不錯。', '2023-05-13 19:15:00'),
	(86, 36, 90, 69, 4, 4, '環境寧靜，適合放鬆用餐。', '2023-05-14 12:30:00'),
	(87, 37, 91, 70, 3, 3, '菜品種類有限，口味還可以。', '2023-05-14 13:15:00'),
	(88, 38, 92, 71, 5, 5, '上菜速度快，服務態度好。', '2023-05-14 14:00:00'),
	(89, 39, 93, 72, 4, 4, '味道不錯，價格合理。', '2023-05-14 14:45:00'),
	(90, 40, 94, 73, 5, 5, '菜品精緻美味，大推！', '2023-05-14 15:30:00'),
	(91, 41, 95, 74, 3, 3, '份量不夠多，有點失望。', '2023-05-14 16:15:00'),
	(92, 42, 96, 75, 4, 4, '服務親切，用餐舒適。', '2023-05-14 17:00:00'),
	(93, 43, 97, 76, 5, 5, '物超所值，推薦給大家。', '2023-05-14 17:45:00'),
	(94, 44, 98, 77, 3, 3, '環境一般，味道還可以。', '2023-05-14 18:30:00'),
	(95, 45, 99, 78, 4, 4, '食材新鮮，料理精緻。', '2023-05-14 19:15:00'),
	(96, 46, 100, 83, 2, 5, 'good', '2023-05-13 10:56:56'),
	(97, 46, 100, 84, 2, 5, 'good', '2023-05-13 10:56:56'),
	(98, 46, 100, 85, 2, 5, 'good', '2023-05-13 10:56:56'),
	(99, 46, 100, 86, 2, 5, 'good', '2023-05-13 10:56:56'),
	(100, 46, 100, 87, 2, 5, 'good', '2023-05-13 10:56:56'),
	(101, 46, 99, 76, 3, 2, 'not good', '2023-05-13 13:30:31'),
	(102, 46, 96, 71, 4, 4, 'great', '2023-05-13 13:31:34'),
	(103, 46, 96, 72, 4, 5, 'great', '2023-05-13 13:31:34'),
	(104, 44, 100, 83, 4, 4, '好吃', '2023-05-13 16:54:00'),
	(105, 44, 100, 84, 4, 3, '好吃', '2023-05-13 16:54:01'),
	(106, 44, 100, 85, 4, 2, '好吃', '2023-05-13 16:54:01'),
	(107, 44, 100, 86, 4, 1, '好吃', '2023-05-13 16:54:01'),
	(108, 44, 100, 87, 4, 5, '好吃', '2023-05-13 16:54:01'),
	(109, 38, 100, 84, 4, 4, 'nice', '2023-05-13 17:07:17'),
	(116, 49, 100, 87, 2, 2, 'XD', '2023-05-25 16:23:07');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
