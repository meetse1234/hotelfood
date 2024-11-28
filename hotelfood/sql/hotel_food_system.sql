-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 11:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_food_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `food_name` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `hotel_id`, `food_name`, `type`, `price`, `description`) VALUES
(1, 1, 'Grilled Salmon', 'Non-Veg', 25.99, 'A deliciously grilled salmon fillet with a hint of lemon and herbs.'),
(2, 1, 'Caesar Salad', 'Veg', 12.99, 'Crisp romaine lettuce, croutons, and Caesar dressing with parmesan cheese.'),
(3, 1, 'Lobster Roll', 'Non-Veg', 35.99, 'Tender lobster meat served in a buttered roll with a side of fries.'),
(4, 2, 'Steak', 'Non-Veg', 40.99, 'Juicy, tender steak cooked to your preference, served with sides.'),
(5, 2, 'Vegetable Soup', 'Veg', 14.99, 'A warm and hearty vegetable soup made with fresh ingredients.'),
(6, 2, 'Lamb Chops', 'Non-Veg', 45.00, 'Succulent lamb chops grilled to perfection and served with mint sauce.'),
(7, 3, 'Pasta Alfredo', 'Veg', 18.99, 'Creamy Alfredo sauce served with fettuccine pasta and parmesan cheese.'),
(8, 3, 'Chicken Sandwich', 'Non-Veg', 15.99, 'Grilled chicken breast with lettuce, tomato, and mayo on a toasted bun.'),
(9, 4, 'Fish Tacos', 'Non-Veg', 12.99, 'Crispy fish fillets in soft tortillas with fresh slaw and a zesty sauce.'),
(10, 4, 'Grilled Veggie Wrap', 'Veg', 11.99, 'A healthy wrap filled with grilled veggies and a tangy dressing.'),
(11, 5, 'Shrimp Cocktail', 'Non-Veg', 30.00, 'Chilled shrimp served with a tangy cocktail sauce for dipping.'),
(12, 5, 'Spinach Dip', 'Veg', 8.99, 'A creamy spinach dip served with tortilla chips or bread.');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `hotel_name`, `location`, `description`, `created_at`, `rating`) VALUES
(1, 'The Grand Palace', 'New York, USA', 'A luxurious hotel offering top-notch services and a scenic view of the city.', '2024-11-28 15:03:44', 4),
(2, 'Seaside Resort', 'Miami, USA', 'A beautiful seaside resort with beaches, pools, and luxury amenities.', '2024-11-28 15:03:44', 3.5),
(3, 'Mountain Retreat', 'Aspen, USA', 'A cozy retreat in the mountains, perfect for outdoor adventures.', '2024-11-28 15:03:44', 4.8),
(4, 'Downtown Inn', 'Los Angeles, USA', 'An affordable and convenient stay with close proximity to the city\'s main attractions.', '2024-11-28 15:03:44', 2.9),
(5, 'Lakeside Lodge', 'Lake Tahoe, USA', 'A charming lodge by the lake offering water sports and hiking opportunities.', '2024-11-28 15:03:44', 3.4),
(6, 'Hotel Sunshine', 'New York', 'A luxury', '2024-01-15 00:00:00', 4.4),
(7, 'Hotel Ocean View', 'California', 'A luxury', '2024-01-20 00:00:00', 4.3),
(8, 'Hotel Forest Retreat', 'Colorado', 'A luxury', '2024-02-10 00:00:00', 3.8),
(9, 'Hotel Mountain Peak', 'Montana', 'A luxury', '2024-03-05 00:00:00', 4.5),
(10, 'Hotel City Center', 'New York', 'A luxury', '2024-03-15 00:00:00', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
