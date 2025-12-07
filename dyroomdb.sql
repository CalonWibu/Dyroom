-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dyroom.mobil
CREATE TABLE IF NOT EXISTS `mobil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `seri` varchar(20) NOT NULL,
  `nama_car` varchar(50) NOT NULL,
  `harga` bigint NOT NULL,
  `speed` int DEFAULT NULL,
  `energy` varchar(15) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `img_car` varchar(255) DEFAULT NULL,
  `img_car_detail` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dyroom.mobil: ~6 rows (approximately)
INSERT INTO `mobil` (`id`, `seri`, `nama_car`, `harga`, `speed`, `energy`, `tipe`, `img_car`, `img_car_detail`, `deskripsi`) VALUES
	(1, 'BUGATTI', 'BUGATTI CHIRON', 20000000000, 300, 'Bensin', 'Super Car', 'bugatti.png', 'chirondisplay.png', 'Bugatti Chiron – Kondisi Second, Mulus & Terawat\n\nDijual Bugatti Chiron kondisi sangat baik, siap pakai, dan terawat dengan baik. Mobil super eksklusif ini tetap menghadirkan performa dan kemewahan khas Bugatti. Dibekali mesin 8.0L Quad-Turbo W16 bertenaga ±1.500 HP dengan transmisi 7-Speed Dual-Clutch Automatic, mobil ini mampu melesat 0–100 km/jam hanya dalam ±2,4 detik dengan kecepatan puncak lebih dari 400 km/jam.\n\nKondisi mobil second, mesin halus dan responsif, interior serta eksterior mulus tanpa lecet berarti. Service rutin selalu dilakukan sesuai standar Bugatti dan tidak ada riwayat tabrakan maupun kerusakan berat.\n\nBugatti Chiron ini merupakan unit langka bernilai koleksi, sangat cocok bagi pecinta supercar maupun kolektor. Harga lebih menarik dibandingkan unit baru namun tetap menawarkan kualitas terbaik.'),
	(2, 'PORCHE', 'PORCHE 718 CAYMAN', 4000000000, 360, 'Bensin', 'SPORT CAR', '2022-Porsche-718-Cayman-GT4-RS-4-removebg-preview (1).png', 'caymandisplay.png', 'Porsche 718 Cayman – Kondisi Second, Mulus & Terawat\n\nDijual Porsche 718 Cayman dalam kondisi sangat baik dan siap pakai. Mobil sport ikonik ini menghadirkan performa khas Porsche dengan handling presisi serta kenyamanan premium.\n\nSpesifikasi Singkat:\n\nMesin: 2.0L Turbocharged Boxer 4-silinder\n\nTenaga: ±300 HP\n\nTransmisi: 6-Speed Manual / 7-Speed PDK Automatic\n\n0–100 km/jam: ±4,9 detik\n\nTop Speed: ±275 km/jam\n\nKondisi Mobil:\n\nSecond (bekas pakai)\n\nMesin terawat, tenaga responsif\n\nInterior dan eksterior bersih, bebas lecet berarti\n\nService rutin sesuai standar Porsche\n\nTidak ada riwayat tabrakan atau kerusakan berat\n\nKelebihan:\n\nUnit sporty dengan desain elegan\n\nCocok untuk pecinta Porsche maupun kolektor sport car\n\nHarga lebih menarik dibandingkan unit baru dengan performa tetap maksimal'),
	(3, 'BENTLEY', 'BENTLEY CONTINENTAL GT', 8000000000, 335, 'Bensin', 'SPORT CAR', '79836972-d159-4ff7-8bc2-6ba8d21bd766-removebg-preview (1).png', 'continentaldisplay.png', 'Bentley Continental GT – Kondisi Second, Mulus & Elegan  Dijual Bentley Continental GT dalam kondisi sangat baik dan siap pakai. Mobil grand tourer mewah ini memadukan performa tinggi dengan kenyamanan premium khas Bentley, menjadikannya pilihan ideal bagi pecinta kemewahan dan performa.  Spesifikasi Singkat:  Mesin: 6.0L W12 Twin-Turbo / 4.0L V8 Twin-Turbo  Tenaga: ±542–626 HP (tergantung varian)  Transmisi: 8-Speed Dual-Clutch Automatic  0–100 km/jam: ±3,7–4,0 detik  Top Speed: ±333 km/jam  Kondisi Mobil:  Second (bekas pakai)  Mesin halus, tenaga responsif  Interior mewah, eksterior mulus tanpa lecet berarti  Service rutin sesuai standar Bentley  Tidak ada riwayat tabrakan atau kerusakan berat  Kelebihan:  Kombinasi sempurna antara kemewahan, kenyamanan, dan performa  Cocok untuk pecinta grand tourer atau kolektor mobil mewah  Harga lebih terjangkau dibanding unit baru dengan kualitas tetap premium'),
	(4, 'BENTLEY', 'BENTLEY BENTAYGA AZURE', 6000000000, 320, 'Bensin', 'Family Car', 'bentayga_azure_gallery_1_1400x700-removebg-preview (1).png', 'Bentaygaazuredisplay.png', 'Dijual Bentley Bentayga Azure dalam kondisi sangat baik dan siap pakai. SUV mewah ini menggabungkan kenyamanan premium, teknologi modern, serta performa khas Bentley yang berkelas.  Spesifikasi Singkat:  Mesin: 4.0L V8 Twin-Turbo / 3.0L V6 Hybrid (tergantung varian)  Tenaga: ±542 HP (V8)  Transmisi: 8-Speed Automatic  0–100 km/jam: ±4,5 detik  Top Speed: ±290 km/jam  Kondisi Mobil:  Second (bekas pakai)  Mesin halus dan responsif  Interior mewah dengan detail elegan khas Azure  Eksterior bersih, bebas lecet berarti  Service rutin sesuai standar Bentley  Tidak ada riwayat tabrakan atau kerusakan berat  Kelebihan:  SUV mewah dengan ruang kabin luas dan nyaman  Cocok untuk keluarga maupun kolektor mobil premium  Harga lebih menarik dibandingkan unit baru dengan kualitas tetap terjaga'),
	(5, 'BENTLEY', 'BENTLEY CONTINENTAL GTC', 8000000000, 335, 'Bensin', 'SPORT CAR', 'New-2025-Bentley-Continental-GTC-Speed-removebg-preview (1).png', 'continentalgtcdisplay.png', 'Bentley Continental GTC – Kondisi Second, Mulus & Elegan  Dijual Bentley Continental GT dalam kondisi sangat baik dan siap pakai. Mobil grand tourer mewah ini memadukan performa tinggi dengan kenyamanan premium khas Bentley, menjadikannya pilihan ideal bagi pecinta kemewahan dan performa.  Spesifikasi Singkat:  Mesin: 6.0L W12 Twin-Turbo / 4.0L V8 Twin-Turbo  Tenaga: ±542–626 HP (tergantung varian)  Transmisi: 8-Speed Dual-Clutch Automatic  0–100 km/jam: ±3,7–4,0 detik  Top Speed: ±333 km/jam  Kondisi Mobil:  Second (bekas pakai)  Mesin halus, tenaga responsif  Interior mewah, eksterior mulus tanpa lecet berarti  Service rutin sesuai standar Bentley  Tidak ada riwayat tabrakan atau kerusakan berat  Kelebihan:  Kombinasi sempurna antara kemewahan, kenyamanan, dan performa  Cocok untuk pecinta grand tourer atau kolektor mobil mewah  Harga lebih terjangkau dibanding unit baru dengan kualitas tetap premium'),
	(6, 'BENTLEY', 'BENTLEY FLYING SPUR', 7000000000, 306, 'Batery', 'Family Car', '2025bentleyflyingspurhybrid13-removebg-preview (1).png', 'FlyingSpurdisplay.png', 'Bentley Flying Spur – Kondisi Second, Mewah & Terawat  Dijual Bentley Flying Spur dalam kondisi sangat baik dan siap pakai. Sedan mewah ini menghadirkan perpaduan sempurna antara performa tinggi, kenyamanan luar biasa, dan kemewahan khas Bentley.  Spesifikasi Singkat:  Mesin: 6.0L W12 Twin-Turbo / 4.0L V8 Twin-Turbo (tergantung varian)  Tenaga: ±542–626 HP  Transmisi: 8-Speed Dual-Clutch Automatic  0–100 km/jam: ±3,8–4,1 detik  Top Speed: ±333 km/jam  Kondisi Mobil:  Second (bekas pakai)  Mesin halus dan responsif  Interior elegan dengan material premium  Eksterior mulus tanpa lecet berarti  Service rutin sesuai standar Bentley  Tidak ada riwayat tabrakan atau kerusakan berat  Kelebihan:  Sedan mewah dengan kenyamanan kelas atas  Cocok untuk eksekutif maupun kolektor mobil premium  Harga lebih menarik dibandingkan unit baru dengan kualitas tetap terjamin');

-- Dumping structure for table dyroom.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `mobil_id` int NOT NULL,
  `banyak` int NOT NULL DEFAULT '1',
  `total_harga` bigint unsigned DEFAULT NULL,
  `status` enum('pending','paid','shipped','cancelled') DEFAULT 'pending',
  `snap_token` varchar(255) DEFAULT NULL,
  `midtrans_order_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `mobil_id` (`mobil_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dyroom.orders: ~13 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `mobil_id`, `banyak`, `total_harga`, `status`, `snap_token`, `midtrans_order_id`, `created_at`) VALUES
	(1, 2, 1, 1, 20000000000, 'paid', NULL, NULL, '2025-08-27 02:01:07'),
	(2, 4, 4, 1, 6000000000, 'paid', NULL, NULL, '2025-08-27 07:43:17'),
	(3, 5, 2, 1, 4000000000, 'paid', NULL, NULL, '2025-08-27 07:46:34'),
	(23, 6, 2, 1, 4000000000, 'paid', NULL, NULL, '2025-08-27 08:57:32'),
	(26, 7, 3, 1, 8000000000, 'paid', NULL, NULL, '2025-08-27 13:52:18'),
	(27, 8, 1, 1, 20000000000, 'paid', NULL, NULL, '2025-08-27 23:53:36'),
	(28, 10, 3, 1, 8000000000, 'paid', NULL, NULL, '2025-08-28 04:25:55'),
	(29, 11, 2, 1, 4000000000, 'paid', NULL, NULL, '2025-09-08 06:27:06'),
	(30, 13, 2, 1, 4000000000, 'paid', NULL, NULL, '2025-10-27 14:04:31'),
	(31, 16, 1, 1, 20000000000, 'paid', NULL, NULL, '2025-11-11 07:08:48'),
	(32, 18, 2, 1, 4000000000, 'pending', NULL, NULL, '2025-11-28 09:26:55'),
	(33, 18, 4, 1, 6000000000, 'pending', NULL, NULL, '2025-11-28 10:08:53'),
	(34, 18, 4, 1, 6000000000, 'pending', NULL, NULL, '2025-11-28 10:09:33');

-- Dumping structure for table dyroom.personal
CREATE TABLE IF NOT EXISTS `personal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pembeli` int DEFAULT NULL,
  `id_mobil` int DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pembeli` (`id_pembeli`),
  KEY `id_mobil` (`id_mobil`),
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `users` (`id`),
  CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dyroom.personal: ~25 rows (approximately)
INSERT INTO `personal` (`id`, `id_pembeli`, `id_mobil`, `country`, `alamat`) VALUES
	(1, 2, 1, 'USA', 'jalan mewing 233'),
	(2, 4, 4, 'Indonesia', 'GG mewing'),
	(3, 5, 2, 'Malaysia', 'jalan sigma'),
	(4, 5, 2, 'Malaysia', 'jalan sigma'),
	(5, 5, 2, 'Malaysia', 'jalan sigma'),
	(6, 5, 2, 'Malaysia', 'jalan sigma'),
	(7, 5, 2, 'Malaysia', 'jalan sigma'),
	(8, 5, 2, 'Malaysia', 'jalan sigma'),
	(9, 5, 2, 'Malaysia', 'jalan sigma'),
	(10, 5, 2, 'Malaysia', 'jalan sigma'),
	(11, 5, 2, 'Malaysia', 'jalan sigma'),
	(12, 5, 2, 'Malaysia', 'jalan sigma'),
	(13, 6, 2, 'Japan', 'jalan hiruzyma nagasaki rt 4 rw 3'),
	(14, 6, 2, 'Japan', 'jalan hiruzyma nagasaki rt 4 rw 3'),
	(15, 6, 2, 'Japan', 'jalan hiruzyma nagasaki rt 4 rw 3'),
	(16, 6, 2, 'Japan', 'erdsfds'),
	(17, 6, 2, 'Japan', 'erdsfds'),
	(18, 6, 2, 'Japan', 'erdsfds'),
	(19, 6, 2, 'Japan', 'erdsfds'),
	(20, 6, 2, 'Japan', 'erdsfds'),
	(21, 6, 2, 'Japan', 'erdsfds'),
	(22, 6, 2, 'Japan', 'erdsfds'),
	(23, 6, 2, 'Japan', 'erdsfds'),
	(24, 7, 3, 'Singapore', 'dsfagsdf'),
	(25, 7, 3, 'Singapore', 'dsfagsdf'),
	(26, 7, 3, 'Singapore', 'dsfagsdf'),
	(27, 8, 1, 'USA', 'jalan kampung arab rt 2 rw 4'),
	(28, 10, 3, 'Singapore', 'RT03 RW04 jalan pegangsaan timur'),
	(29, 11, 2, 'Singapore', 'jalan singotrunan rinjani'),
	(30, 13, 2, 'USA', 'jln mewong'),
	(31, 16, 1, 'India', 'singotrunan'),
	(32, 18, 2, 'Indonesia', 'jj'),
	(33, 18, 4, 'Malaysia', '4'),
	(34, 18, 4, 'Malaysia', '4');

-- Dumping structure for table dyroom.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dyroom.users: ~14 rows (approximately)
INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`) VALUES
	(2, 'tono', '', 'Unboxchenel@gmail.com', '$2y$10$472i0oDtTTfaDSjemhSzducMgUbsvYPQ88hgA7xricGKx1/L8/uYa', '1'),
	(3, 'kiki kocak', '', 'kikikocak@gmail.com', '$2y$10$YNwpXuuHSWj5mIEk0TLMsuf4b9IQZQqFFvsUqQJErS0qngxBXJS6m', '0'),
	(4, 'alvin', '', 'jomok24@gmail.com', '$2y$10$QcqevN4SGbmDyqDLcaGKZegLd7T8ybpaBQIXycJira6rSyAKpiixi', '0'),
	(5, 'tante ridwan', '', 'pepoireiprajau-8715@yopmail.com', '$2y$10$OfAmRnzK6QUOazbnDreKiOhjQyDtvYtQs9qiH4ciT.jD0GxY5PdLi', '0'),
	(6, 'maiki', '', 'maikisalamun@gmail.com', '$2y$10$Km/4VsVNOPYYBRl/qlVAc.qpKgRrlyQ/szj/OQkKAP9FFQOZka5aK', '0'),
	(7, 'mewing', '', 'mewingmewong@gmail.com', '$2y$10$out5bUa4M40/pCk9zfKeBeqq4fXgaI0.ltjEmCj56GJcJqa6f901i', '0'),
	(8, 'arkan', '', 'pudidi@gmail.id', '$2y$10$eTtAoRmUj24G8XMHPI1DlOKXJhykdakGyOn.VOTnebIwxUVkoCvea', '1'),
	(9, 'fairus', '', 'konsuidfgyugf@gmail.com', '$2y$10$gOgKBJ8V3MeGuYbDNh28m.OX/Gq7me7H4c4udTI0/HKvp6nrP.rNa', '0'),
	(10, 'ellena', '', 'ellenaterisonpurnomo@gmail.com', '$2y$10$CUCXZD2XYFYqU3bnhyajz.mHHrKsGrrf4E.xBQkjUT/GmeCgDINSC', '1'),
	(11, 'rendy batagor', '', 'rendy@gmail.com', '$2y$10$bTk96WJne5AZHOdDVH5EPe3Wi3VvpuLHpHBmjPBDTfSpLCi8i1RJK', '1'),
	(12, 'admin', '', 'admin@lalys.id', '$2y$10$1tA5/czqeXeeziu0k/cuIuuvgqwo2VUA/gKC.WNWBfctxDDuxXmWu', '1'),
	(13, 'tante ridwanss', '', 'mewing@kocak.com', '$2y$10$J8OA0.gstVTvTCvbS9AczOVCVV5QxTGLdA72J.CVAwhFKTVc24ogu', '1'),
	(14, 'fachry', '', 'mewing@gmail.co.id.slot', '$2y$10$/J3w0Cm/TNAD.UMdKoxy5uJyhZGF9ioFhsVZfPakfSwLgVH5fw1XG', '1'),
	(15, 'bugattisdfsdfdsf', '', 'Unbowasdsadsadxchenel@gmail.com', '$2y$10$6BCVtASdiTHcoIiOUlMi/esivHYNcRLvF/vj3t4ChY2ooWXx8ii8q', '0'),
	(16, 'tante ridwan sdfdsf', '', 'arabbebek9@gmail.com', '$2y$10$WwZt5vc.Ad.0z67uLZ8TweWatI.wujmMxjOs2LZEHJP35HxEJIy56', '0'),
	(17, 'fachry emir', '', 'aqua@gmail.com', '$2y$10$Fuv7TtEAB8UZNjf9Gw2bouPCB1EN5oRYzumuOjnA0FhICMWU6M.VS', '1'),
	(18, 'fugut', '', 'fugut@gmail.com', '$2y$10$EmTiFuIfg28l1Gb69J7vdOT2B6sX6gU.KvXJs6bAQjDPkvRHfgxFW', '1'),
	(19, 'jujutsu', '', 'jujutsu@gmail.com', '$2y$10$HrNh3diENMToaRJaNJEtv.D3B7AGFhbXMQfbmnBJ4jTEIlSxjhF4u', '1');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
