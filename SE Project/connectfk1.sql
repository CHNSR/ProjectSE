-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 09:08 AM
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
-- Database: `connectfk1`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_customerID`, `cus_username`, `cus_password`, `cus_firstname`, `cus_lastname`, `cus_phoneNumber`, `cus_gender`, `cus_birthday`, `cus_email`) VALUES
(1, 'user1', 'pass1', 'John', 'Doe', '1234567890', 'Male', '1990-01-20', 'john@example.com'),
(2, 'user2', 'pass2', 'Jane', 'Smith', '9876543210', 'Fema', '2000-08-09', 'jane@example.com'),
(3, 'user3', 'pass3', 'Alice', 'Johnson', '5551234567', 'Fema', '2010-05-16', 'alice@example.com'),
(4, 'user4', 'pass4', 'Bob', 'Johnson', '5559876543', 'Male', '1998-10-05', 'bob@example.com'),
(5, 'user5', 'pass5', 'David', 'Brown', '1112223333', 'Male', '1970-09-24', 'david@example.com'),
(6, 'user6', 'pass6', 'Emma', 'Davis', '4445556666', 'Fema', '1989-03-30', 'emma@example.com'),
(7, 'user7', 'pass7', 'Michael', 'Wilson', '7778889999', 'Male', '2003-09-08', 'michael@example.com'),
(8, 'user8', 'pass8', 'Olivia', 'Taylor', '2223334444', 'Fema', '2002-09-08', 'olivia@example.com'),
(9, 'user9', 'pass9', 'James', 'Martinez', '6667778888', 'Male', '2005-08-18', 'james@example.com'),
(10, 'user10', 'pass10', 'Sophia', 'Anderson', '9998887777', 'Fema', '2011-11-11', 'sophia@example.com'),
(11, 'user11', 'pass11', 'chanon', 'sukrod', '099-892-8773', 'Male', '2002-08-06', 'chanonsukrod@gmail.com'),
(12, 'user12', 'pass12', 'chanom', 'sukrot', '065-431-3720', 'Fema', '2003-12-10', 'chnsr@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dessert_menu`
--

INSERT INTO `dessert_menu` (`dess_menuID`, `dess_menuName`, `dess_quantity`, `dess_price`, `dess_picture`) VALUES
(1, 'Chocolate Cake', 20, 100, 'des_1.jpg'),
(2, 'Cheesecake', 12, 120, 'des_2.jpg'),
(3, 'Apple Pie', 18, 110, 'des_3.jpg'),
(4, 'Brownie', 25, 90, 'des_4.jpg'),
(5, 'Ice Cream Sundae', 21, 130, 'des_5.jpg'),
(6, 'Fruit Tart', 16, 140, 'des_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_employeeID` int(10) NOT NULL,
  `emp_branchID` int(10) DEFAULT NULL,
  `emp_username` varchar(30) NOT NULL,
  `emp_password` varchar(50) NOT NULL,
  `emp_employeelevel` varchar(1) NOT NULL,
  `emp_birthday` date NOT NULL,
  `emp_name` varchar(40) NOT NULL,
  `emp_sername` varchar(40) NOT NULL,
  `emp_ID` varchar(16) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_tell` varchar(10) NOT NULL,
  `emp_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_employeeID`, `emp_branchID`, `emp_username`, `emp_password`, `emp_employeelevel`, `emp_birthday`, `emp_name`, `emp_sername`, `emp_ID`, `emp_address`, `emp_tell`, `emp_email`) VALUES
(1, 1, 'user1', 'pass1', 'A', '1988-12-20', 'jane', 'smith', '1639922582068', '33/4 หมู่ 2 ตำบล ป่ามะม่วง อ.เมือง จ. ตาก 63000', '0654321458', 'sss335@gmail.com'),
(2, 1, 'user2', 'pass2', 'B', '1988-12-20', 'jane', 'smith', '1639922582068', '33/4 หมู่ 2 ตำบล ป่ามะม่วง อ.เมือง จ. ตาก 63000', '0654321459', 'sss335@gmail.com'),
(3, 2, 'user3', 'pass3', 'C', '1993-03-25', 'gojo', 'widodo', '1634566345827', '', '0678980012', '3543qqwer@nu.ac.th'),
(4, 2, 'user4', 'pass4', 'A', '1991-09-05', 'sam', 'smith', '1630056087733', '', '0654317700', 'dd2s@nu.ac.th'),
(5, 2, 'user5', 'pass5', 'B', '1992-11-12', 'jane', 'sonya', '1654325804467', '', '0875678901', 'dd2s3@nu.ac.th'),
(6, 3, 'user6', 'pass6', 'C', '1989-04-17', 'samson', 'dodo', '1345677854321', '', '0690003321', 'adf3@gamil.com'),
(7, 3, 'user7', 'pass7', 'A', '1990-05-15', 'John', 'Doe', '1234567890123456', '123 Main Street', '1234567890', 'john@example.com'),
(8, 2, 'user8', 'pass8', 'B', '1988-09-20', 'Jane', 'Smith', '6543210987654321', '456 Elm Street', '0987654321', 'jane@example.com'),
(9, 1, 'user9', 'pass9', 'C', '1995-02-10', 'Alice', 'Jones', '9876543210123456', '789 Oak Street', '5555555555', 'alice@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fb_feedbackID` int(10) NOT NULL,
  `fb_customerID` int(10) DEFAULT NULL,
  `fb_orderID` int(10) NOT NULL,
  `fb_rating` int(1) NOT NULL,
  `fb_comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fruit_menu`
--

INSERT INTO `fruit_menu` (`fruit_menuID`, `fruit_menuName`, `fruit_quantity`, `fruit_price`, `fruit_picture`) VALUES
(1, 'Apple', 49, 10, 'fru_1.jpg'),
(2, 'Banana', 54, 8, 'fru_2.jpg'),
(3, 'Orange', 34, 12, 'fru_3.jpg'),
(4, 'Grapes', 30, 15, 'fru_4.jpg'),
(5, 'Strawberry', 44, 20, 'fru_5.jpg'),
(6, 'Watermelon', 17, 25, 'fru_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ord_detailID` int(10) NOT NULL,
  `ord_orderID` int(10) DEFAULT NULL,
  `ord_productID` int(11) NOT NULL,
  `ord_productType` varchar(255) DEFAULT NULL,
  `ord_productName` varchar(255) NOT NULL,
  `ord_quantity` int(3) NOT NULL,
  `ord_totalPrice` decimal(10,0) NOT NULL,
  `ord_price` int(11) NOT NULL,
  `ord_option` varchar(255) NOT NULL,
  `ord_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`ord_detailID`, `ord_orderID`, `ord_productID`, `ord_productType`, `ord_productName`, `ord_quantity`, `ord_totalPrice`, `ord_price`, `ord_option`, `ord_status`) VALUES
(1, 6, 5, 'coffee', 'Hot Chocolate', 1, 55, 55, 'Hot', 'Success'),
(2, 7, 5, 'coffee', 'Hot Chocolate', 1, 55, 55, 'Hot', 'wait'),
(3, 8, 2, 'dessert', 'Cheesecake', 1, 120, 120, '-', 'wait'),
(4, 8, 3, 'fruit', 'Orange', 1, 12, 12, '-', 'wait'),
(5, 8, 5, 'coffee', 'Hot Chocolate', 1, 55, 55, 'Hot', 'wait'),
(6, 10, 2, 'fruit', 'Banana', 1, 8, 8, '-', 'wait'),
(7, 10, 6, 'dessert', 'Fruit Tart', 1, 140, 140, '-', 'wait'),
(8, 11, 4, 'coffee', 'Cucumber Cooler', 1, 45, 45, 'Cold', 'wait'),
(9, 12, 8, 'milk', 'Mint Mojito', 1, 55, 55, 'Cold', 'wait'),
(10, 13, 9, 'tea', 'Chamomile Tea', 1, 45, 45, 'Hot', 'wait'),
(11, 14, 8, 'milk', 'Mint Mojito', 1, 55, 55, 'Cold', 'wait'),
(12, 14, 2, 'dessert', 'Cheesecake', 1, 120, 120, '-', 'wait'),
(13, 14, 6, 'fruit', 'Watermelon', 1, 25, 25, '-', 'wait'),
(14, 15, 6, 'fruit', 'Watermelon', 1, 25, 25, '-', 'wait'),
(15, 15, 5, 'fruit', 'Strawberry', 1, 20, 20, '-', 'wait'),
(16, 15, 3, 'fruit', 'Orange', 1, 12, 12, '-', 'wait'),
(17, 16, 5, 'coffee', 'Hot Chocolate', 1, 55, 55, 'Hot', 'wait'),
(18, 17, 5, 'coffee', 'Hot Chocolate', 1, 55, 55, 'Hot', 'wait');

-- --------------------------------------------------------

--
-- Table structure for table `order_main`
--

CREATE TABLE `order_main` (
  `ord_orderID` int(255) NOT NULL,
  `ord_orderDate` datetime NOT NULL,
  `ord_customerID` int(10) DEFAULT NULL,
  `ord_employeeID` int(10) DEFAULT NULL,
  `ord_total` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_main`
--

INSERT INTO `order_main` (`ord_orderID`, `ord_orderDate`, `ord_customerID`, `ord_employeeID`, `ord_total`) VALUES
(6, '2024-04-09 09:47:57', 6, 1, 55),
(7, '2024-04-09 09:54:25', 6, 4, 55),
(8, '2024-04-10 07:42:38', 11, 7, 187),
(10, '2024-04-10 07:57:05', NULL, 1, 148),
(11, '2024-04-10 10:31:10', NULL, 4, 45),
(12, '2024-04-10 11:31:25', NULL, 7, 55),
(13, '2024-04-10 17:32:18', NULL, 1, 45),
(14, '2024-04-10 15:32:46', NULL, 1, 200),
(15, '2024-04-10 12:33:20', NULL, 7, 57),
(16, '2024-04-12 08:33:14', NULL, NULL, 55),
(17, '2024-04-12 08:44:43', NULL, 1, 55);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `p_pointID` int(10) NOT NULL,
  `p_customerID` int(10) DEFAULT NULL,
  `p_pointTotal` int(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`p_pointID`, `p_customerID`, `p_pointTotal`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0),
(12, 11, 0),
(14, 12, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_of_water`
--

CREATE TABLE `recipe_of_water` (
  `rec_menuID` int(10) NOT NULL,
  `rec_waterMenuID` int(10) DEFAULT NULL,
  `rec_description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recipe_of_water`
--

INSERT INTO `recipe_of_water` (`rec_menuID`, `rec_waterMenuID`, `rec_description`) VALUES
(1, NULL, '1. Preheat oven to 350°F (175°C). 2. Mix flour, sugar, and baking powder. 3. Add milk, eggs, and vanilla. 4. Pour batter into greased pan. 5. Bake for 30 minutes.'),
(2, NULL, '1. Crush graham crackers and mix with melted butter. 2. Press mixture into a pan to form a crust. 3. Mix cream cheese, sugar, and vanilla until smooth. 4. Pour mixture onto crust. 5. Refrigerate for 4 hours.'),
(3, NULL, '1. Preheat oven to 375°F (190°C). 2. Mix sliced apples, sugar, and cinnamon. 3. Pour mixture into pie crust. 4. Cover with another pie crust. 5. Bake for 45 minutes.'),
(4, NULL, '1. Melt chocolate and butter. 2. Mix with sugar and eggs. 3. Add flour and mix until smooth. 4. Pour batter into greased pan. 5. Bake for 25 minutes.'),
(5, NULL, '1. Scoop ice cream into a bowl. 2. Top with whipped cream, chocolate syrup, and a cherry.'),
(6, NULL, '1. Preheat oven to 350°F (175°C). 2. Mix flour, sugar, and baking powder. 3. Add milk, eggs, and vanilla. 4. Pour batter into greased pan. 5. Bake for 30 minutes.'),
(7, NULL, '1. Crush graham crackers and mix with melted butter. 2. Press mixture into a pan to form a crust. 3. Mix cream cheese, sugar, and vanilla until smooth. 4. Pour mixture onto crust. 5. Refrigerate for 4 hours.'),
(8, NULL, '1. Preheat oven to 375°F (190°C). 2. Mix sliced apples, sugar, and cinnamon. 3. Pour mixture into pie crust. 4. Cover with another pie crust. 5. Bake for 45 minutes.'),
(9, NULL, '1. Melt chocolate and butter. 2. Mix with sugar and eggs. 3. Add flour and mix until smooth. 4. Pour batter into greased pan. 5. Bake for 25 minutes.'),
(10, NULL, '1. Scoop ice cream into a bowl. 2. Top with whipped cream, chocolate syrup, and a cherry.');

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `rd_redeemID` int(11) NOT NULL,
  `rd_customerName` varchar(255) NOT NULL,
  `rd_redeemOrder` varchar(255) NOT NULL,
  `rd_option` varchar(255) NOT NULL,
  `rd_expire` datetime NOT NULL,
  `rd_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(10, 'Strawberry Lemonade', 'coffee', 'Cold', 60, 'water_10.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_main`
--
ALTER TABLE `branch_main`
  ADD PRIMARY KEY (`b_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_customerID`),
  ADD KEY `cus_customerID` (`cus_customerID`);

--
-- Indexes for table `dessert_menu`
--
ALTER TABLE `dessert_menu`
  ADD PRIMARY KEY (`dess_menuID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_employeeID`),
  ADD KEY `emp_branchID` (`emp_branchID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_feedbackID`),
  ADD KEY `fb_customerID` (`fb_customerID`);

--
-- Indexes for table `fruit_menu`
--
ALTER TABLE `fruit_menu`
  ADD PRIMARY KEY (`fruit_menuID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ord_detailID`),
  ADD KEY `ord_orderID` (`ord_orderID`);

--
-- Indexes for table `order_main`
--
ALTER TABLE `order_main`
  ADD PRIMARY KEY (`ord_orderID`),
  ADD KEY `ord_customerID` (`ord_customerID`),
  ADD KEY `ord_employeeID` (`ord_employeeID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_paymentID`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`p_pointID`),
  ADD KEY `p_customerID` (`p_customerID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promo_promotionID`);

--
-- Indexes for table `recipe_of_water`
--
ALTER TABLE `recipe_of_water`
  ADD PRIMARY KEY (`rec_menuID`),
  ADD KEY `rec_waterMenuID` (`rec_waterMenuID`);

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
-- AUTO_INCREMENT for table `branch_main`
--
ALTER TABLE `branch_main`
  MODIFY `b_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_customerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dessert_menu`
--
ALTER TABLE `dessert_menu`
  MODIFY `dess_menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_employeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_feedbackID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fruit_menu`
--
ALTER TABLE `fruit_menu`
  MODIFY `fruit_menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ord_detailID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_main`
--
ALTER TABLE `order_main`
  MODIFY `ord_orderID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `p_pointID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `rd_redeemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `water_menu`
--
ALTER TABLE `water_menu`
  MODIFY `w_menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`emp_branchID`) REFERENCES `branch_main` (`b_ID`) ON DELETE SET NULL;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`fb_customerID`) REFERENCES `customer` (`cus_customerID`) ON DELETE SET NULL;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`ord_orderID`) REFERENCES `order_main` (`ord_orderID`) ON DELETE CASCADE;

--
-- Constraints for table `order_main`
--
ALTER TABLE `order_main`
  ADD CONSTRAINT `order_main_ibfk_1` FOREIGN KEY (`ord_customerID`) REFERENCES `customer` (`cus_customerID`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_main_ibfk_2` FOREIGN KEY (`ord_employeeID`) REFERENCES `employee` (`emp_employeeID`) ON DELETE SET NULL;

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`p_customerID`) REFERENCES `customer` (`cus_customerID`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_of_water`
--
ALTER TABLE `recipe_of_water`
  ADD CONSTRAINT `recipe_of_water_ibfk_1` FOREIGN KEY (`rec_waterMenuID`) REFERENCES `water_menu` (`w_menuID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
