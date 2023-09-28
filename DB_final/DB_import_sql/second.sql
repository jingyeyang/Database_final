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

-- 傾印  資料表 final.menu_items 結構
CREATE TABLE IF NOT EXISTS `menu_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_id` int NOT NULL,
  `name` char(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`item_id`) USING BTREE,
  KEY `FK_menu_restaurant_restaurant_id` (`restaurant_id`),
  CONSTRAINT `FK_menu_restaurant_restaurant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在傾印表格  final.menu_items 的資料：~30 rows (近似值)
INSERT INTO `menu_items` (`item_id`, `restaurant_id`, `name`, `description`, `price`) VALUES
	(59, 90, '宮保雞丁', '雞肉、花生、辣椒等配料炒製而成的經典川菜', 120),
	(60, 90, '麻婆豆腐', '嫩滑豆腐配上麻辣醬汁，麻辣鮮香', 80),
	(61, 91, '炸醬麵', '經典的東北麵食，麵條搭配濃郁的炸醬汁', 65),
	(62, 91, '鍋包肉', '酥脆的豬肉片裹上甜酸口味的醬汁', 95),
	(63, 92, '蝦餃', '香嫩的蝦肉製成的蒸餃，口感鮮美', 55),
	(64, 92, '叉燒包', '香甜的叉燒肉包裹在軟綿的麵皮中', 35),
	(65, 93, '三杯雞', '用三杯醬汁炖煮的雞肉，香氣四溢', 110),
	(66, 93, '蚵仔煎', '台灣特色小吃，蚵仔與麵煎製而成', 90),
	(67, 94, '牛肉麵', '鮮嫩的牛肉配上勁道的麵條，湯汁濃郁', 75),
	(68, 94, '炒牛河', '寬粉炒製的牛肉河粉，口感豐富', 85),
	(69, 95, '椒鹽排骨', '香脆的椒鹽排骨，外酥里嫩，美味可口', 105),
	(70, 95, '蒜蓉粉絲蒸扇貝', '新鮮扇貝蒸製，搭配蒜蓉和粉絲', 135),
	(71, 96, '燒鴨飯', '香脆的燒鴨片搭配米飯，美味可口', 95),
	(72, 96, '蔥油餅', '煎至香脆的蔥油餅，外酥里軟，美味可口', 40),
	(73, 97, '酸辣湯', '酸辣味道的湯品，口感鲜美開胃', 45),
	(74, 98, '蝦球', '鮮嫩的大蝦球，外酥里嫩，味道鮮美', 120),
	(75, 98, '蒜香炒蛤蜊', '蒜香味濃郁的炒蛤蜊，鮮嫩多汁', 95),
	(76, 99, '魚香茄子', '魚香味的茄子炒菜，口感鮮美', 80),
	(77, 99, '脆皮烤鴨', '外酥里嫩的脆皮烤鴨，肉質鮮美', 150),
	(78, 90, '蒸魚', '鮮嫩的蒸魚，搭配特製醬汁', 110),
	(79, 90, '薑蔥蟹', '濃郁的薑蔥味道，搭配鮮美的蟹肉', 180),
	(80, 91, '炸薯條', '金黃酥脆的炸薯條，美味可口', 55),
	(81, 91, '糖醋排骨', '酸甜口味的糖醋排骨，外脆內嫩', 90),
	(82, 92, '炒時蔬', '新鮮時蔬炒製，保留原汁原味', 65),
	(83, 100, '麻辣火鍋', '辣味十足的火鍋，適合喜歡辣食的人', 150),
	(84, 100, '酸菜魚', '口感鮮嫩的魚肉搭配酸菜和香辣湯底', 120),
	(85, 100, '水煮肉片', '嫩滑的豬肉片搭配辣椒和豆瓣醬', 100),
	(86, 100, '回鍋肉', '酥脆的肉片配上麻辣醬汁，回味無窮', 90),
	(87, 100, '蛋餅', '薄脆蛋皮，美味餡料，風味獨特', 20),
	(91, 103, '雞排', '嗨嗨', 88);

-- 傾印  資料表 final.orders 結構
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  `order_time` datetime NOT NULL,
  `delivery_time` datetime NOT NULL,
  `delivery_address` char(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `total_price` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FK_order_restaurant_restaurant_id` (`restaurant_id`),
  KEY `FK_order_user_user_id` (`user_id`),
  CONSTRAINT `FK_order_restaurant_restaurant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_order_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在傾印表格  final.orders 的資料：~19 rows (近似值)
INSERT INTO `orders` (`order_id`, `user_id`, `restaurant_id`, `order_time`, `delivery_time`, `delivery_address`, `total_price`) VALUES
	(116, 36, 90, '2023-05-13 12:30:00', '2023-05-13 13:00:00', '台北市信義區', 240),
	(117, 37, 91, '2023-05-13 13:45:00', '2023-05-13 14:30:00', '新竹市東區', 160),
	(118, 38, 92, '2023-05-13 18:20:00', '2023-05-13 19:00:00', '高雄市前鎮區', 110),
	(119, 39, 93, '2023-05-13 19:10:00', '2023-05-13 19:45:00', '台中市南區', 200),
	(120, 40, 94, '2023-05-13 20:00:00', '2023-05-13 20:45:00', '彰化市中正路', 160),
	(121, 41, 95, '2023-05-14 12:30:00', '2023-05-14 13:00:00', '桃園市中興路', 190),
	(122, 42, 96, '2023-05-14 13:45:00', '2023-05-14 14:30:00', '基隆市仁愛路', 290),
	(123, 43, 97, '2023-05-14 18:20:00', '2023-05-14 19:00:00', '嘉義市西區', 180),
	(124, 44, 98, '2023-05-14 19:10:00', '2023-05-14 19:45:00', '苗栗縣中山路', 240),
	(125, 45, 99, '2023-05-14 20:00:00', '2023-05-14 20:45:00', '南投市中山路', 290),
	(126, 46, 100, '2023-05-13 10:55:36', '2023-05-13 11:15:36', '第一學生宿舍', 1150),
	(127, 46, 100, '2023-05-13 13:28:58', '2023-05-13 13:48:58', '第一學生宿舍', 750),
	(128, 46, 99, '2023-05-13 13:29:59', '2023-05-13 13:49:59', '第一學生宿舍', 80),
	(129, 46, 96, '2023-05-13 13:30:50', '2023-05-13 13:50:50', '第一學生宿舍', 135),
	(130, 42, 100, '2023-05-13 16:52:17', '2023-05-13 17:12:17', '新竹市東區', 1330),
	(131, 44, 100, '2023-05-13 16:52:55', '2023-05-13 17:12:55', '嘉義市西區', 3090),
	(132, 37, 100, '2023-05-13 17:05:47', '2023-05-13 17:25:47', '台中市西區', 750),
	(133, 38, 100, '2023-05-13 17:06:13', '2023-05-13 17:26:13', '高雄市鳳山區', 360),
	(136, 49, 100, '2023-05-25 16:21:56', '2023-05-25 16:41:56', '苗栗大安區', 20);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
