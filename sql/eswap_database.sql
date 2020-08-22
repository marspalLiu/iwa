-- DataBase Table
-- barters : barter_id owner_id barter_name barter_description purchase_date swap_for
-- category : category_id category_name
-- users :user_id user_name role user_email password

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `barters` (
  `barter_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `barter_name` varchar(128) NOT NULL,
  `barter_description` text NOT NULL,
  `purchase_date` date NOT NULL,
  `swap_for` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `barters` (`barter_id`, `owner_id`, `category_id`,`barter_name`, `barter_description`, `purchase_date`, `swap_for`) VALUES 
(1,1,1,'HUAWEI P40 Pro','6.58 inches, OLED capacitive touchscreen, 16M colors, 1200 x 2640 pixels (~441 ppi density) 256GB Storage | 8GB RAM | Android 10.0 (AOSP + HMS); EMUI 10.1, HiSilicon Kirin 990 5G (7 nm+)', '2020/6/18',' Laptop or tablet'),
(2,2,1,'Apple iPhone 11 Pro Max','6.5-inch Super Retina XDR OLED display Water and dust resistant (4 meters for up to 30 minutes, IP68) Triple-camera system with 12MP Ultra Wide, Wide, and Telephoto cameras; Night mode, Portrait mode, and 4K video up to 60fps 12MP TrueDepth front camera with Portrait mode, 4K video, ','2020/5/3','Android Smartphone'),
(3,1,2,'New Apple MacBook Pro','Ninth-generation 6-Core Intel Core i7 Processor Stunning 16-inch Retina Display with True Tone technology Touch Bar and Touch ID AMD Radeon Pro 5300M Graphics with GDDR6 memory Ultrafast SSD Intel UHD Graphics 630 Six-speaker system with force-cancelling woofers', '2020/3/11','windows laptop'),
(4,2,2,'HUAWEI Matebook x Pro','Immersive 13.9-inch 3K touchscreen with 91% screen-to-body ratio, only 0.57-inch thin and weighs only 2.93 lbs., 8th Gen Intel Core i7 8550U processor + NVIDIA GeForce MX150 - boosts performance up to 40% over its predecessor,3K touchscreen with 3, 000 x 2, 000 resolution, ','2020/2/8','MacBook'),
(5,1,6,'giant panda pillow', 'Cute giant panda hugs bear doll plush toy super soft sleeping pillow','2020/1/6','clothes or shoes');


CREATE TABLE `categories` (
    `category_id` int(11) NOT NULL,
    `category_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1,'Smartphone'),
(2,'Laptop'),
(3,'Tablet'),
(4,'Clothes'),
(5,'Shoes'),
(6,'Toys'),
(7,'Others');

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `role` enum('ADMINISTRATOR','GENERAL') NOT NULL DEFAULT 'GENERAL',
  `email` tinytext NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `user_name`, `login_name`, `email`, `phone`, `country`,`password`) VALUES
(1, 'Meng Zechen','mzc', '12345678', '12345678', 'China','$2y$10$NXXLYiSF.viKgyBDqqsaXe2YAizndCoksyNESzWyara0vlCAWidB.'),
(2, 'Sha Jintao','sjt', '12345678', '12345678', 'China','$2y$10$NXXLYiSF.viKgyBDqqsaXe2YAizndCoksyNESzWyara0vlCAWidB.'),
(3, 'Liu Xin','lx', '12345678', '12345678', 'China','$2y$10$NXXLYiSF.viKgyBDqqsaXe2YAizndCoksyNESzWyara0vlCAWidB.');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `barters`
--
ALTER TABLE `barters`
  ADD PRIMARY KEY (`barter_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barters`
--
ALTER TABLE `barters`
  MODIFY `barter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- ----------------------------
-- Table structure for messsages
-- ----------------------------
DROP TABLE IF EXISTS `messsages`;
CREATE TABLE `messsages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `send_user_id` int(11) NOT NULL,
  `exchange_user_id` int(11) NOT NULL,
  `exchange_object_id` int(11) NOT NULL,
  `be_exchanged_user_id` int(11) NOT NULL,
  `be_exchanged_object_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of messsages
-- ----------------------------

COMMIT;