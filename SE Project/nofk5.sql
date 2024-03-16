-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 07:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nofk5`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch_detail`
--

CREATE TABLE `branch_detail` (
  `bd_ID` int(10) NOT NULL,
  `bd_branchID` int(10) NOT NULL,
  `bd_employeeID` int(10) NOT NULL,
  `bd_customerID` int(10) DEFAULT NULL,
  `bd_waterMenuID` int(10) DEFAULT NULL,
  `bd_dessertID` int(10) DEFAULT NULL,
  `bd_fruitID` int(10) DEFAULT NULL,
  `bd_number` int(3) NOT NULL,
  `bd_price` int(4) NOT NULL,
  `bd_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_detail`
--

INSERT INTO `branch_detail` (`bd_ID`, `bd_branchID`, `bd_employeeID`, `bd_customerID`, `bd_waterMenuID`, `bd_dessertID`, `bd_fruitID`, `bd_number`, `bd_price`, `bd_date`) VALUES
(1, 1, 1, 1, 1, 1, 1, 2, 100, '2024-01-01'),
(2, 2, 2, 2, 2, 2, 2, 1, 120, '2024-01-02'),
(3, 3, 3, 3, 3, 3, 3, 3, 180, '2024-01-03'),
(4, 4, 4, 4, 4, 4, 4, 1, 150, '2024-01-04'),
(5, 5, 5, 5, 5, 5, 5, 2, 200, '2024-01-05'),
(6, 1, 1, 1, 1, 1, 1, 1, 100, '2024-01-06'),
(7, 2, 2, 2, 2, 2, 2, 2, 240, '2024-01-07'),
(8, 3, 3, 3, 3, 3, 3, 1, 80, '2024-01-08'),
(9, 4, 4, 4, 4, 4, 4, 3, 270, '2024-01-09'),
(10, 5, 5, 5, 5, 5, 5, 2, 160, '2024-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `branch_main`
--

CREATE TABLE `branch_main` (
  `b_ID` int(6) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_subdistrict` varchar(100) NOT NULL,
  `b_district` varchar(100) NOT NULL,
  `b_province` varchar(100) NOT NULL,
  `b_sector` varchar(100) NOT NULL,
  `b_coordinates` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_main`
--

INSERT INTO `branch_main` (`b_ID`, `b_name`, `b_subdistrict`, `b_district`, `b_province`, `b_sector`, `b_coordinates`) VALUES
(1, 'Branch A', 'Subdistrict A1', 'District A1', 'Province A', 'Sector 1', '13.7563° N, 100.5018° E'),
(2, 'Branch B', 'Subdistrict B1', 'District B1', 'Province B', 'Sector 2', '13.7278° N, 100.5241° E'),
(3, 'Branch C', 'Subdistrict C1', 'District C1', 'Province C', 'Sector 3', '13.7308° N, 100.5218° E'),
(4, 'Branch D', 'Subdistrict D1', 'District D1', 'Province D', 'Sector 1', '13.7510° N, 100.4905° E'),
(5, 'Branch E', 'Subdistrict E1', 'District E1', 'Province E', 'Sector 2', '13.7422° N, 100.5572° E'),
(6, 'Branch F', 'Subdistrict F1', 'District F1', 'Province F', 'Sector 3', '13.7327° N, 100.5526° E'),
(7, 'Branch G', 'Subdistrict G1', 'District G1', 'Province G', 'Sector 1', '13.7500° N, 100.5144° E'),
(8, 'Branch H', 'Subdistrict H1', 'District H1', 'Province H', 'Sector 2', '13.7462° N, 100.5035° E'),
(9, 'Branch I', 'Subdistrict I1', 'District I1', 'Province I', 'Sector 3', '13.7263° N, 100.5155° E'),
(10, 'Branch J', 'Subdistrict J1', 'District J1', 'Province J', 'Sector 1', '13.7394° N, 100.5562° E');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_customerID` int(10) NOT NULL,
  `cus_username` varchar(40) NOT NULL,
  `cus_password` varchar(40) NOT NULL,
  `cus_firstname` varchar(40) NOT NULL,
  `cus_lastname` varchar(40) NOT NULL,
  `cus_phoneNumber` varchar(12) NOT NULL,
  `cus_gender` varchar(4) NOT NULL,
  `cus_birthday` date NOT NULL,
  `cus_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_customerID`, `cus_username`, `cus_password`, `cus_firstname`, `cus_lastname`, `cus_phoneNumber`, `cus_gender`, `cus_birthday`, `cus_email`) VALUES
(1, 'john_doe', 'password123', 'John', 'Doe', '1234567890', 'Male', '1990-01-20', 'john@example.com'),
(2, 'jane_smith', 'pass321', 'Jane', 'Smith', '9876543210', 'Fema', '2000-08-09', 'jane@example.com'),
(3, 'user3', 'password3', 'Alice', 'Johnson', '5551234567', 'Fema', '2010-05-16', 'alice@example.com'),
(4, 'user4', 'pass4', 'Bob', 'Johnson', '5559876543', 'Male', '1998-10-05', 'bob@example.com'),
(5, 'user5', 'pwd5', 'David', 'Brown', '1112223333', 'Male', '1970-09-24', 'david@example.com'),
(6, 'user6', 'pass6', 'Emma', 'Davis', '4445556666', 'Fema', '1989-03-30', 'emma@example.com'),
(7, 'user7', 'pass7', 'Michael', 'Wilson', '7778889999', 'Male', '2003-09-08', 'michael@example.com'),
(8, 'user8', 'pass8', 'Olivia', 'Taylor', '2223334444', 'Fema', '2002-09-08', 'olivia@example.com'),
(9, 'user9', 'pass9', 'James', 'Martinez', '6667778888', 'Male', '2005-08-18', 'james@example.com'),
(10, 'user10', 'pass10', 'Sophia', 'Anderson', '9998887777', 'Fema', '2011-11-11', 'sophia@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `dessert_menu`
--

CREATE TABLE `dessert_menu` (
  `dess_menuID` int(10) NOT NULL,
  `dess_menuName` varchar(255) NOT NULL,
  `dess_quantity` int(3) DEFAULT NULL,
  `dess_price` int(3) NOT NULL,
  `dess_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dessert_menu`
--

INSERT INTO `dessert_menu` (`dess_menuID`, `dess_menuName`, `dess_quantity`, `dess_price`, `dess_picture`) VALUES
(1, 'Chocolate Cake', 20, 100, 'des_1.jpg'),
(2, 'Cheesecake', 15, 120, 'des_2.jpg'),
(3, 'Apple Pie', 18, 110, 'des_3.jpg'),
(4, 'Brownie', 25, 90, 'des_4.jpg'),
(5, 'Ice Cream Sundae', 22, 130, 'des_5.jpg'),
(6, 'Fruit Tart', 17, 140, 'des_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_employeeID` int(10) NOT NULL,
  `emp_username` varchar(30) NOT NULL,
  `emp_password` varchar(50) NOT NULL,
  `emp_employeelevel` varchar(1) NOT NULL,
  `emp_birthday` date NOT NULL,
  `emp_name` varchar(40) NOT NULL,
  `emp_sername` varchar(40) NOT NULL,
  `emp_ID` varchar(13) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_tell` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_employeeID`, `emp_username`, `emp_password`, `emp_employeelevel`, `emp_birthday`, `emp_name`, `emp_sername`, `emp_ID`, `emp_address`, `emp_tell`) VALUES
(1, 'john_doe', 'password123', 'A', '1990-05-15', '', '', '', '', ''),
(2, 'jane_smith', 'pass321', 'B', '1988-12-20', '', '', '', '', ''),
(3, 'user3', 'password3', 'C', '1995-07-10', '', '', '', '', ''),
(4, 'user4', 'pass4', 'B', '1993-03-25', '', '', '', '', ''),
(5, 'user5', 'pwd5', 'A', '1991-09-05', '', '', '', '', ''),
(6, 'user6', 'pass6', 'C', '1992-11-12', '', '', '', '', ''),
(7, 'user7', 'pass7', 'A', '1989-04-17', '', '', '', '', ''),
(8, 'user8', 'pass8', 'B', '1994-08-22', '', '', '', '', ''),
(9, 'user9', 'pass9', 'C', '1997-02-28', '', '', '', '', ''),
(10, 'user10', 'pass10', 'A', '1998-06-03', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fb_feedbackID` int(10) NOT NULL,
  `fb_customerID` int(10) NOT NULL,
  `fb_orderID` int(10) NOT NULL,
  `fb_rating` int(1) NOT NULL,
  `fb_comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fb_feedbackID`, `fb_customerID`, `fb_orderID`, `fb_rating`, `fb_comment`) VALUES
(1, 1, 1, 4, 'The food was delicious!'),
(2, 2, 2, 5, 'Great service and tasty desserts!'),
(3, 3, 3, 3, 'The drink could have been colder.'),
(4, 4, 4, 5, 'Excellent experience overall.'),
(5, 5, 5, 4, 'The fruit was fresh and tasty.'),
(6, 1, 6, 4, 'Love the smoothies!'),
(7, 2, 7, 2, 'Disappointed with the dessert selection.'),
(8, 3, 8, 5, 'Best chocolate cake ever!'),
(9, 4, 9, 3, 'Expected more from the menu.'),
(10, 5, 10, 4, 'Good value for the price.');

-- --------------------------------------------------------

--
-- Table structure for table `fruit_menu`
--

CREATE TABLE `fruit_menu` (
  `fruit_menuID` int(10) NOT NULL,
  `fruit_menuName` varchar(255) NOT NULL,
  `fruit_quantity` int(3) DEFAULT NULL,
  `fruit_price` int(3) NOT NULL,
  `fruit_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fruit_menu`
--

INSERT INTO `fruit_menu` (`fruit_menuID`, `fruit_menuName`, `fruit_quantity`, `fruit_price`, `fruit_picture`) VALUES
(1, 'Apple', 50, 10, 'fru_1.jpg'),
(2, 'Banana', 58, 8, 'fru_2.jpg'),
(3, 'Orange', 40, 12, 'fru_3.jpg'),
(4, 'Grapes', 30, 15, 'fru_4.jpg'),
(5, 'Strawberry', 45, 20, 'fru_5.jpg'),
(6, 'Watermelon', 20, 25, 'fru_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ord_detailID` int(10) NOT NULL,
  `ord_orderID` int(10) NOT NULL,
  `ord_productID` int(11) NOT NULL,
  `ord_productType` varchar(255) DEFAULT NULL,
  `ord_productName` varchar(255) NOT NULL,
  `ord_quantity` int(3) NOT NULL,
  `ord_totalPrice` decimal(10,0) NOT NULL,
  `ord_price` int(11) NOT NULL,
  `ord_option` varchar(255) NOT NULL,
  `ord_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`ord_detailID`, `ord_orderID`, `ord_productID`, `ord_productType`, `ord_productName`, `ord_quantity`, `ord_totalPrice`, `ord_price`, `ord_option`, `ord_status`) VALUES
(1, 1, 6, '', 'Watermelon', 1, 25, 25, '', ''),
(2, 2, 1, '', 'Apple', 1, 10, 10, '', ''),
(3, 3, 0, '', 'อเมริกาโน่', 2, 100, 50, '', ''),
(4, 3, 0, '', 'Cheesecake', 2, 240, 120, '', ''),
(5, 3, 0, '', 'Banana', 1, 8, 8, '', ''),
(6, 3, 0, '', 'Watermelon', 2, 50, 25, '', ''),
(7, 4, 1, '', 'อเมริกาโน่', 2, 100, 50, '', ''),
(8, 4, 0, '', 'Chocolate Cake', 2, 200, 100, '', ''),
(9, 4, 0, '', 'Apple', 2, 20, 10, '', ''),
(10, 4, 7, '', 'โกโก้', 2, 140, 70, '', ''),
(11, 5, 1, '', 'อเมริกาโน่', 1, 50, 50, '', ''),
(12, 5, 4, '', 'ลาเต้', 1, 45, 45, '', ''),
(13, 6, 1, '', 'Chocolate Cake', 1, 100, 100, '', ''),
(14, 6, 6, '', 'Fruit Tart', 1, 140, 140, '', ''),
(15, 6, 6, '', 'Watermelon', 1, 25, 25, '', ''),
(16, 6, 3, '', 'Orange', 1, 12, 12, '', ''),
(17, 7, 1, '', 'อเมริกาโน่', 3, 150, 50, 'Blen', ''),
(18, 7, 4, '', 'ลาเต้', 1, 45, 45, 'Cold', ''),
(19, 7, 7, '', 'โกโก้', 1, 70, 70, 'Cold', ''),
(20, 7, 2, '', 'อเมริกาโน่ส้ม', 1, 40, 40, 'Cold', ''),
(21, 7, 3, '', 'เอสเพรสโซ่', 1, 60, 60, 'Blen', ''),
(22, 7, 9, '', 'ชากุหลาบ', 2, 90, 45, 'Hot', ''),
(23, 7, 5, '', 'Ice Cream Sundae', 1, 130, 130, '-', ''),
(24, 7, 3, '', 'Apple Pie', 1, 110, 110, '-', ''),
(25, 7, 2, '', 'Banana', 5, 40, 8, '-', ''),
(26, 7, 6, '', 'Watermelon', 1, 25, 25, '-', ''),
(27, 8, 4, '', 'ลาเต้', 4, 180, 45, 'Cold', ''),
(28, 8, 7, '', 'โกโก้', 1, 70, 70, 'Cold', ''),
(29, 8, 8, '', 'ชาเขียว', 1, 55, 55, 'Cold', ''),
(30, 9, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(31, 10, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(32, 11, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(33, 12, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(34, 13, 1, '', 'Chocolate Cake', 6, 600, 100, '-', ''),
(35, 0, 1, '', 'อเมริกาโน่', 2, 100, 50, 'Blen', ''),
(36, 15, 1, '', 'อเมริกาโน่', 2, 100, 50, 'Blen', ''),
(37, 0, 1, '', 'อเมริกาโน่', 1, 50, 50, 'Blen', ''),
(38, 0, 3, '', 'เอสเพรสโซ่', 1, 60, 60, 'Blen', ''),
(39, 22, 1, '', 'อเมริกาโน่', 1, 50, 50, 'Blen', ''),
(40, 22, 10, '', 'ชาแอปเปิ้ล', 1, 60, 60, 'Cold', ''),
(41, 23, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(42, 24, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(43, 25, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(44, 26, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(45, 27, 1, '', 'Chocolate Cake', 1, 100, 100, '-', ''),
(46, 27, 3, '', 'Apple Pie', 1, 110, 110, '-', ''),
(47, 27, 6, '', 'Fruit Tart', 2, 280, 140, '-', ''),
(48, 28, 2, '', 'Cheesecake', 2, 240, 120, '-', ''),
(49, 29, 3, '', 'Orange', 1, 12, 12, '-', ''),
(50, 30, 4, '', 'Grapes', 1, 15, 15, '-', ''),
(51, 31, 1, '', 'อเมริกาโน่', 1, 50, 50, 'Blen', ''),
(52, 31, 3, '', 'เอสเพรสโซ่', 1, 60, 60, 'Blen', ''),
(53, 31, 2, '', 'อเมริกาโน่ส้ม', 1, 40, 40, 'Cold', ''),
(54, 32, 1, '', 'อเมริกาโน่', 1, 50, 50, 'Blen', ''),
(55, 32, 3, '', 'เอสเพรสโซ่', 2, 120, 60, 'Blen', ''),
(56, 33, 4, '', 'Grapes', 2, 30, 15, '-', ''),
(57, 34, 1, '', 'อเมริกาโน่', 2, 100, 50, 'Blen', ''),
(58, 0, 1, '', 'Apple', 1, 0, 0, '-', ''),
(59, 0, 1, '', 'อเมริกาโน่', 1, 0, 0, 'Blen', ''),
(60, 40, 1, '', 'อเมริกาโน่', 1, 0, 0, 'Blen', ''),
(61, 40, 1, '', 'Chocolate Cake', 1, 0, 0, '-', ''),
(62, 40, 1, '', 'Apple', 1, 0, 0, '-', ''),
(63, 41, 1, '', 'อเมริกาโน่', 1, 0, 0, 'Blen', ''),
(64, 41, 1, '', 'อเมริกาโน่', 1, 0, 0, 'Blen', ''),
(65, 48, 4, '', 'ลาเต้', 1, 0, 0, 'Cold', ''),
(66, 49, 1, '', 'อเมริกาโน่', 2, 100, 50, 'Blen', 'Success'),
(67, 50, 1, '', 'Chocolate Cake', 1, 100, 100, '-', 'Success'),
(68, 51, 4, '', 'ลาเต้', 1, 45, 45, 'Cold', 'Success'),
(69, 51, 7, '', 'โกโก้', 1, 70, 70, 'Cold', 'Cancle'),
(70, 51, 3, '', 'Apple Pie', 1, 110, 110, '-', 'Cancle'),
(71, 52, 4, '', 'ลาเต้', 1, 45, 45, 'Cold', 'Cancle'),
(72, 53, 4, '', 'ลาเต้', 1, 45, 45, 'Cold', 'Success'),
(73, 53, 7, '', 'โกโก้', 1, 70, 70, 'Cold', 'wait'),
(74, 54, 1, 'coffee', 'อเมริกาโน่', 2, 100, 50, 'Blen', 'wait'),
(75, 55, 4, 'coffee', 'ลาเต้', 1, 0, 0, 'Cold', ''),
(76, 55, 1, 'dessert', 'Chocolate Cake', 1, 0, 0, '-', ''),
(77, 56, 4, 'coffee', 'ลาเต้', 1, 45, 45, 'Cold', 'wait'),
(78, 57, 3, 'milk', 'เอสเพรสโซ่', 1, 60, 60, 'Blen', 'wait'),
(79, 58, 1, 'coffee', 'อเมริกาโน่', 1, 50, 50, 'Blen', 'wait'),
(80, 59, 5, 'tea', 'มอคค่า', 1, 55, 55, 'Hot', 'wait'),
(81, 60, 8, 'tea', 'ชาเขียว', 1, 55, 55, 'Cold', 'wait'),
(82, 61, 4, 'coffee', 'ลาเต้', 1, 45, 45, 'Cold', 'wait'),
(83, 62, 2, 'tea', 'อเมริกาโน่ส้ม', 1, 40, 40, 'Cold', 'wait'),
(84, 63, 6, 'milk', 'คาปูชิโน่', 1, 65, 65, 'Blen', 'wait'),
(85, 64, 9, 'milk', 'ชากุหลาบ', 1, 45, 45, 'Hot', 'wait'),
(86, 65, 8, 'tea', 'ชาเขียว', 1, 55, 55, 'Cold', 'wait'),
(87, 66, 1, 'dessert', 'Chocolate Cake', 1, 100, 100, '-', 'wait'),
(88, 66, 2, 'dessert', 'Cheesecake', 1, 120, 120, '-', 'wait'),
(89, 66, 3, 'dessert', 'Apple Pie', 1, 110, 110, '-', 'wait'),
(90, 66, 4, 'dessert', 'Brownie', 1, 90, 90, '-', 'wait'),
(91, 66, 5, 'dessert', 'Ice Cream Sundae', 1, 130, 130, '-', 'wait'),
(92, 66, 6, 'dessert', 'Fruit Tart', 1, 140, 140, '-', 'wait'),
(93, 67, 1, 'fruit', 'Apple', 1, 10, 10, '-', 'wait'),
(94, 67, 2, 'fruit', 'Banana', 1, 8, 8, '-', 'wait'),
(95, 67, 3, 'fruit', 'Orange', 1, 12, 12, '-', 'wait'),
(96, 67, 4, 'fruit', 'Grapes', 1, 15, 15, '-', 'wait'),
(97, 67, 5, 'fruit', 'Strawberry', 1, 20, 20, '-', 'wait'),
(98, 68, 1, 'dessert', 'Chocolate Cake', 3, 300, 100, '-', 'wait'),
(99, 68, 2, 'dessert', 'Cheesecake', 3, 360, 120, '-', 'wait'),
(100, 68, 3, 'dessert', 'Apple Pie', 3, 330, 110, '-', 'wait'),
(101, 68, 4, 'dessert', 'Brownie', 2, 180, 90, '-', 'wait'),
(102, 68, 5, 'dessert', 'Ice Cream Sundae', 4, 520, 130, '-', 'wait'),
(103, 68, 6, 'dessert', 'Fruit Tart', 2, 280, 140, '-', 'wait'),
(104, 69, 1, 'fruit', 'Apple', 4, 40, 10, '-', 'wait'),
(105, 69, 2, 'fruit', 'Banana', 3, 24, 8, '-', 'wait'),
(106, 69, 3, 'fruit', 'Orange', 3, 36, 12, '-', 'wait'),
(107, 69, 4, 'fruit', 'Grapes', 3, 45, 15, '-', 'wait'),
(108, 69, 5, 'fruit', 'Strawberry', 6, 120, 20, '-', 'wait'),
(109, 13, 1, NULL, 'Lemonade', 1, 50, 50, 'Cold', 'wait'),
(110, 13, 9, NULL, 'Chamomile Tea', 1, 45, 45, 'Hot', 'wait'),
(111, 14, 1, NULL, 'Lemonade', 1, 50, 50, 'Cold', 'wait'),
(112, 14, 8, NULL, 'Mint Mojito', 1, 55, 55, 'Cold', 'wait');

-- --------------------------------------------------------

--
-- Table structure for table `order_main`
--

CREATE TABLE `order_main` (
  `ord_orderID` int(255) NOT NULL,
  `ord_orderDate` date NOT NULL,
  `ord_customerID` int(10) NOT NULL,
  `ord_employeeID` int(10) NOT NULL,
  `ord_total` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_main`
--

INSERT INTO `order_main` (`ord_orderID`, `ord_orderDate`, `ord_customerID`, `ord_employeeID`, `ord_total`) VALUES
(1, '2024-02-01', 1, 1, 0),
(2, '2024-02-02', 2, 2, 0),
(3, '2024-02-03', 3, 3, 0),
(4, '2024-02-04', 4, 1, 0),
(5, '2024-02-05', 5, 2, 0),
(6, '2024-02-06', 1, 3, 0),
(7, '2024-02-07', 2, 1, 0),
(8, '2024-02-08', 3, 2, 0),
(9, '2024-02-09', 4, 3, 0),
(10, '2024-02-10', 5, 1, 0),
(11, '2024-02-15', 3, 0, 185),
(12, '2024-02-15', 3, 0, 185),
(13, '2024-02-20', 3, 0, 95),
(14, '2024-02-20', 0, 0, 105);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_paymentID` int(50) NOT NULL,
  `pay_orderID` int(11) NOT NULL,
  `pay_paymentMethod` varchar(100) NOT NULL,
  `pay_amount` decimal(10,0) NOT NULL,
  `pay_promotionID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_paymentID`, `pay_orderID`, `pay_paymentMethod`, `pay_amount`, `pay_promotionID`) VALUES
(1, 1, 'Credit Card', 240, NULL),
(2, 2, 'Cash', 50, NULL),
(3, 3, 'Debit Card', 80, NULL),
(4, 4, 'Cash', 30, NULL),
(5, 5, 'Credit Card', 240, NULL),
(6, 6, 'Debit Card', 35, NULL),
(7, 7, 'Cash', 180, NULL),
(8, 8, 'Credit Card', 14, NULL),
(9, 9, 'Debit Card', 270, NULL),
(10, 10, 'Cash', 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `p_pointID` int(10) NOT NULL,
  `p_customerName` varchar(255) NOT NULL,
  `p_pointTotal` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`p_pointID`, `p_customerName`, `p_pointTotal`) VALUES
(1, 'john_doe', '100'),
(2, 'jane_smith', '50'),
(3, 'user3', '294.'),
(4, 'user4', '70'),
(5, 'user5', '300'),
(6, 'user6', '75'),
(7, 'user7', '400'),
(8, 'user8', '200'),
(9, 'user9', '25'),
(10, 'user10', '500');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promo_promotionID` int(10) NOT NULL,
  `promo_water` int(10) DEFAULT NULL,
  `promo_dessert` int(10) DEFAULT NULL,
  `promo_fruit` int(10) DEFAULT NULL,
  `promo_promotionName` varchar(100) NOT NULL,
  `promo_description` varchar(500) NOT NULL,
  `promo_startDate` date NOT NULL,
  `promo_endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promo_promotionID`, `promo_water`, `promo_dessert`, `promo_fruit`, `promo_promotionName`, `promo_description`, `promo_startDate`, `promo_endDate`) VALUES
(1, 1, NULL, NULL, 'Summer Special', 'Enjoy refreshing discounts on all water items!', '2024-06-01', '2024-06-30'),
(2, NULL, 1, NULL, 'Dessert Delight', 'Indulge in our delectable desserts at discounted prices!', '2024-07-01', '2024-07-31'),
(3, NULL, NULL, 1, 'Fruit Fiesta', 'Treat yourself with our fresh fruit specials!', '2024-08-01', '2024-08-31'),
(4, 2, NULL, NULL, 'Thirst Quencher', 'Stay hydrated with our special discounts on selected water items!', '2024-09-01', '2024-09-30'),
(5, NULL, 2, NULL, 'Sweet Tooth Treat', 'Satisfy your sweet cravings with our discounted desserts!', '2024-10-01', '2024-10-31'),
(6, NULL, NULL, 2, 'Fruit Bonanza', 'Enjoy the goodness of fruits with our exclusive offers!', '2024-11-01', '2024-11-30'),
(7, 3, NULL, NULL, 'Hydration Booster', 'Revitalize yourself with discounted prices on our water menu!', '2024-12-01', '2024-12-31'),
(8, NULL, 3, NULL, 'Dessert Delight', 'Treat yourself with our delectable desserts at special prices!', '2025-01-01', '2025-01-31'),
(9, NULL, NULL, 3, 'Fruit Paradise', 'Experience the burst of flavors with our fruit promotions!', '2025-02-01', '2025-02-28'),
(10, 4, NULL, NULL, 'Summer Sips', 'Beat the heat with our summer beverage promotions!', '2025-03-01', '2025-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_of_water`
--

CREATE TABLE `recipe_of_water` (
  `rec_menuID` int(10) NOT NULL,
  `rec_description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_of_water`
--

INSERT INTO `recipe_of_water` (`rec_menuID`, `rec_description`) VALUES
(1, '1. Preheat oven to 350°F (175°C). 2. Mix flour, sugar, and baking powder. 3. Add milk, eggs, and vanilla. 4. Pour batter into greased pan. 5. Bake for 30 minutes.'),
(2, '1. Crush graham crackers and mix with melted butter. 2. Press mixture into a pan to form a crust. 3. Mix cream cheese, sugar, and vanilla until smooth. 4. Pour mixture onto crust. 5. Refrigerate for 4 hours.'),
(3, '1. Preheat oven to 375°F (190°C). 2. Mix sliced apples, sugar, and cinnamon. 3. Pour mixture into pie crust. 4. Cover with another pie crust. 5. Bake for 45 minutes.'),
(4, '1. Melt chocolate and butter. 2. Mix with sugar and eggs. 3. Add flour and mix until smooth. 4. Pour batter into greased pan. 5. Bake for 25 minutes.'),
(5, '1. Scoop ice cream into a bowl. 2. Top with whipped cream, chocolate syrup, and a cherry.'),
(6, '1. Preheat oven to 350°F (175°C). 2. Mix flour, sugar, and baking powder. 3. Add milk, eggs, and vanilla. 4. Pour batter into greased pan. 5. Bake for 30 minutes.'),
(7, '1. Crush graham crackers and mix with melted butter. 2. Press mixture into a pan to form a crust. 3. Mix cream cheese, sugar, and vanilla until smooth. 4. Pour mixture onto crust. 5. Refrigerate for 4 hours.'),
(8, '1. Preheat oven to 375°F (190°C). 2. Mix sliced apples, sugar, and cinnamon. 3. Pour mixture into pie crust. 4. Cover with another pie crust. 5. Bake for 45 minutes.'),
(9, '1. Melt chocolate and butter. 2. Mix with sugar and eggs. 3. Add flour and mix until smooth. 4. Pour batter into greased pan. 5. Bake for 25 minutes.'),
(10, '1. Scoop ice cream into a bowl. 2. Top with whipped cream, chocolate syrup, and a cherry.'),
(0, '----');

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `rd_redeemID` int(11) NOT NULL,
  `rd_customerName` varchar(255) NOT NULL,
  `rd_redeemOrder` varchar(255) NOT NULL,
  `rd_option` varchar(255) NOT NULL,
  `rd_expire` date NOT NULL,
  `rd_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`rd_redeemID`, `rd_customerName`, `rd_redeemOrder`, `rd_option`, `rd_expire`, `rd_status`) VALUES
(1, 'jane_smith', 'อเมริกาโน่', '', '2024-02-22', ''),
(2, 'jane_smith', 'Apple', '', '2024-02-22', ''),
(3, 'jane_smith', 'ลาเต้', '', '2024-02-23', ''),
(4, 'jane_smith', 'อเมริกาโน่', 'Blen', '2024-02-23', ''),
(5, 'jane_smith', 'ชากุหลาบ', 'Hot', '2024-02-23', ''),
(6, 'jane_smith', 'อเมริกาโน่ส้ม', 'Cold', '2024-02-23', ''),
(7, 'jane_smith', 'Apple Pie', '-', '2024-02-23', ''),
(8, 'jane_smith', 'Banana', '-', '2024-02-23', ''),
(9, 'jane_smith', 'Apple', '-', '2024-02-23', ''),
(10, 'jane_smith', 'อเมริกาโน่', 'Blen', '2024-02-24', ''),
(11, 'agosz2', 'อเมริกาโน่', 'Blen', '2024-02-24', ''),
(12, 'agosz2', 'ลาเต้', 'Cold', '2024-02-24', ''),
(13, 'agosz2', 'โกโก้', 'Cold', '2024-02-24', ''),
(14, 'jane_smith', 'Apple', '-', '2024-02-24', ''),
(15, 'jane_smith', 'Strawberry', '-', '2024-02-24', ''),
(16, 'jane_smith', 'Apple', '-', '2024-02-24', 'redeemed'),
(17, 'dadaf', 'อเมริกาโน่', 'Blen', '2024-02-24', 'redeemed'),
(18, 'dadaf', 'อเมริกาโน่', 'Blen', '2024-02-24', 'redeemed'),
(19, 'dadaf', 'Chocolate Cake', '-', '2024-02-24', 'redeemed'),
(20, 'dadaf', 'Apple', '-', '2024-02-24', 'redeemed'),
(21, 'dadaf', 'อเมริกาโน่', 'Blen', '2024-02-24', 'redeemed'),
(22, 'dadaf', 'อเมริกาโน่', 'Blen', '2024-02-24', 'redeemed'),
(23, 'dadaf', 'ลาเต้', 'Cold', '2024-02-24', 'redeemed'),
(24, 'dadaf', 'ลาเต้', 'Cold', '2024-02-24', 'redeemable'),
(25, 'dadaf', 'Chocolate Cake', '-', '2024-02-24', 'redeemable'),
(26, 'user4', 'Banana', '-', '2024-02-27', 'redeemable'),
(27, 'user4', 'Banana', '-', '2024-02-27', 'redeemable');

-- --------------------------------------------------------

--
-- Table structure for table `water_menu`
--

CREATE TABLE `water_menu` (
  `w_menuID` int(10) NOT NULL,
  `w_menuName` varchar(255) NOT NULL,
  `w_waterType` varchar(255) NOT NULL,
  `w_HotColdBlended` varchar(4) NOT NULL,
  `w_price` int(3) NOT NULL,
  `w_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_menu`
--

INSERT INTO `water_menu` (`w_menuID`, `w_menuName`, `w_waterType`, `w_HotColdBlended`, `w_price`, `w_picture`) VALUES
(1, 'Lemonade', 'coffee', 'Cold', 50, 'water_1.jpg'),
(2, 'Iced Tea', 'tee', 'Cold', 40, 'water_2.jpg'),
(3, 'Green Tea Smoothie', 'tea', 'Blen', 60, 'water_3.jpg'),
(4, 'Cucumber Cooler', 'coffee', 'Cold', 45, 'water_4.jpg'),
(5, 'Hot Chocolate', 'coffee', 'Hot', 55, 'water_5.jpg'),
(6, 'Berry Blast Smoothie', 'Smoothie', 'Blen', 65, 'water_6.jpg'),
(7, 'Coconut Water', 'coffee', 'Cold', 70, 'water_7.jpg'),
(8, 'Mint Mojito', 'milk', 'Cold', 55, 'water_8.jpg'),
(9, 'Chamomile Tea', 'tea', 'Hot', 45, 'water_9.jpg'),
(10, 'Strawberry Lemonade', 'coffee', 'Cold', 60, 'water_10.jpg'),
(12, 'dd', 'coffee', 'Hot', 50, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_detail`
--
ALTER TABLE `branch_detail`
  ADD PRIMARY KEY (`bd_ID`);

--
-- Indexes for table `branch_main`
--
ALTER TABLE `branch_main`
  ADD PRIMARY KEY (`b_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_customerID`);

--
-- Indexes for table `dessert_menu`
--
ALTER TABLE `dessert_menu`
  ADD PRIMARY KEY (`dess_menuID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_employeeID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_feedbackID`);

--
-- Indexes for table `fruit_menu`
--
ALTER TABLE `fruit_menu`
  ADD PRIMARY KEY (`fruit_menuID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ord_detailID`);

--
-- Indexes for table `order_main`
--
ALTER TABLE `order_main`
  ADD PRIMARY KEY (`ord_orderID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_paymentID`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`p_pointID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promo_promotionID`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`rd_redeemID`);

--
-- Indexes for table `water_menu`
--
ALTER TABLE `water_menu`
  ADD PRIMARY KEY (`w_menuID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch_detail`
--
ALTER TABLE `branch_detail`
  MODIFY `bd_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `branch_main`
--
ALTER TABLE `branch_main`
  MODIFY `b_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_customerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dessert_menu`
--
ALTER TABLE `dessert_menu`
  MODIFY `dess_menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_employeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_feedbackID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fruit_menu`
--
ALTER TABLE `fruit_menu`
  MODIFY `fruit_menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ord_detailID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `order_main`
--
ALTER TABLE `order_main`
  MODIFY `ord_orderID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_paymentID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `p_pointID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promo_promotionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `rd_redeemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `water_menu`
--
ALTER TABLE `water_menu`
  MODIFY `w_menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
