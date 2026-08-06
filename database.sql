-- AviNest Enterprise Database Schema
-- Database: avinest_db

CREATE DATABASE IF NOT EXISTS `avinest_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `avinest_db`;

-- --------------------------------------------------------
-- Table: users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'breeder', 'user') NOT NULL DEFAULT 'user',
  `status` ENUM('active', 'unactive') NOT NULL DEFAULT 'active',
  `avatar` VARCHAR(255) DEFAULT 'images/african_grey.png',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: deleted_users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `deleted_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `deleted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: categories
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(50) NOT NULL UNIQUE,
  `name_en` VARCHAR(100) NOT NULL,
  `name_ur` VARCHAR(100) NOT NULL,
  `image_url` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: birds
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `birds` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `user_id` INT DEFAULT NULL,
  `name` VARCHAR(150) NOT NULL,
  `sci_name` VARCHAR(150) NOT NULL,
  `origin` VARCHAR(100) NOT NULL,
  `lifespan` VARCHAR(50) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `volume` VARCHAR(50) NOT NULL DEFAULT 'Quiet',
  `friendly` TINYINT(1) NOT NULL DEFAULT 1,
  `intel_level` VARCHAR(50) NOT NULL DEFAULT 'Active Learner',
  `status` ENUM('available', 'sold', 'pending') NOT NULL DEFAULT 'available',
  `verified` TINYINT(1) NOT NULL DEFAULT 1,
  `image_url` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `date_listed` DATE DEFAULT (CURRENT_DATE),
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: inquiries
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `bird_id` INT DEFAULT NULL,
  `buyer_name` VARCHAR(100) NOT NULL,
  `buyer_email` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `date_sent` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`bird_id`) REFERENCES `birds`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Seed Data: Categories
-- --------------------------------------------------------
INSERT INTO `categories` (`id`, `slug`, `name_en`, `name_ur`, `image_url`) VALUES
(1, 'parrots', 'Parrots', 'طوطے', 'images/african_grey.png'),
(2, 'cockatiels', 'Cockatiels', 'کوکاٹیل', 'images/cockatiel.png'),
(3, 'budgies', 'Budgies', 'بجی طوطے', 'images/budgie.png'),
(4, 'macaws', 'Macaws', 'مکاؤ', 'images/scarlet_macaw.png'),
(5, 'lovebirds', 'Lovebirds', 'لوبرڈز', 'images/lovebird.png'),
(6, 'finches', 'Finches', 'فینچ', 'images/finch.png'),
(7, 'canaries', 'Canaries', 'کینری (سرخی مائل)', 'images/canary.png')
ON DUPLICATE KEY UPDATE `slug`=`slug`;

-- --------------------------------------------------------
-- Seed Data: Users
-- Admin Default Password: admin123 ($2y$10$B50dI326vYy0.T3vF9R40e6.Wk1hI9XG1hH.8wQzP4E9rT9xS8R5u)
-- Breeder Default Password: password123 ($2y$10$e7K4b.dYV6C.7qU7.g6Q0.qJ3K2X.5Y7Z.8A9B0C1D2E3F4G5H6I)
-- --------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `status`, `avatar`) VALUES
(1, 'AviNest Admin', 'admin@avinest.com', '$2y$10$5GXL58MyM/6CripmJyb/jOSzHgLGXwaGF5k4fchdUr5ew7q15q/TO', 'admin', 'active', 'images/african_grey.png'),
(2, 'Luxe Avian Farms', 'luxe@avianfarms.com', '$2y$10$yhcMUzRHiG0yL64nZ9pum.3vGvOJlGVBYc3E6gcW.DsrCkIEEZKkS', 'breeder', 'active', 'images/scarlet_macaw.png'),
(3, 'Sunny Wings Breeding', 'sunny@wings.com', '$2y$10$yhcMUzRHiG0yL64nZ9pum.3vGvOJlGVBYc3E6gcW.DsrCkIEEZKkS', 'breeder', 'active', 'images/sun_conure.png'),
(4, 'Apex Breeders', 'apex@breeders.com', '$2y$10$yhcMUzRHiG0yL64nZ9pum.3vGvOJlGVBYc3E6gcW.DsrCkIEEZKkS', 'breeder', 'active', 'images/cockatiel.png'),
(5, 'Tiny Wings Aviary', 'tiny@wings.com', '$2y$10$yhcMUzRHiG0yL64nZ9pum.3vGvOJlGVBYc3E6gcW.DsrCkIEEZKkS', 'breeder', 'unactive', 'images/finch.png')
ON DUPLICATE KEY UPDATE `email`=`email`;

-- --------------------------------------------------------
-- Seed Data: Birds (Empty by default. Populated only by registered user posts)
-- --------------------------------------------------------
-- --------------------------------------------------------
-- Table structure for table `feedbacks`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `category` varchar(100) DEFAULT 'General Experience',
  `comment` text NOT NULL,
  `status` enum('approved','pending') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `admin_announcements`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `admin_announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT 1,
  `admin_name` varchar(255) DEFAULT 'AviNest Admin',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(100) DEFAULT 'Community Notice',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `announcement_comments`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `announcement_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `announcement_id` (`announcement_id`),
  CONSTRAINT `fk_announcement_comments` FOREIGN KEY (`announcement_id`) REFERENCES `admin_announcements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
