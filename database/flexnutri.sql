-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 08:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexnutri`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) NOT NULL,
  `brandName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brandName`) VALUES
(1, 'OPTIMUM NUTRIATION'),
(2, 'ULTIMATE NUTRIATION'),
(3, 'BSN'),
(4, 'GAT'),
(5, 'BPI'),
(6, 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(10) NOT NULL,
  `cateName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cateName`) VALUES
(1, 'WHEY PROTEIN'),
(2, 'CASEIN PROTEIN'),
(3, 'FAT BURNERS '),
(4, 'MASS GAINERS'),
(5, 'VITAMINS'),
(6, 'Energy Drink');

-- --------------------------------------------------------

--
-- Table structure for table `flavor`
--

CREATE TABLE `flavor` (
  `id` int(10) NOT NULL,
  `flavorName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flavor`
--

INSERT INTO `flavor` (`id`, `flavorName`) VALUES
(1, 'CHOCOLATE'),
(2, 'VANILLA'),
(3, 'DARK CHOCOLATE'),
(4, 'ORANGE'),
(5, 'WATERMELON'),
(6, 'Vanila');

-- --------------------------------------------------------

--
-- Table structure for table `gst`
--

CREATE TABLE `gst` (
  `id` int(11) NOT NULL,
  `slab` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gst`
--

INSERT INTO `gst` (`id`, `slab`) VALUES
(1, '2'),
(2, '3'),
(3, '5'),
(4, '18'),
(5, '12'),
(6, '9'),
(7, '10'),
(8, '11');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) NOT NULL,
  `custName` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `totalAmt` double NOT NULL,
  `gstType` varchar(20) NOT NULL,
  `payMode` varchar(20) NOT NULL,
  `profit` double NOT NULL,
  `custGst` varchar(30) NOT NULL,
  `custMobile` varchar(12) NOT NULL,
  `custAdds` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `custName`, `mobile`, `date`, `totalAmt`, `gstType`, `payMode`, `profit`, `custGst`, `custMobile`, `custAdds`) VALUES
(1, 'Akash Jogani', '', '2023-08-29', 600, 'gst', 'online', 0, '-', '9742020863', 'Belgaum'),
(2, 'akash', '', '2023-08-30', 1200, 'igst', 'online', 0, '', '7353231800', 'Azam Nagar'),
(3, 'sagar', '', '2023-08-30', 1500, 'gst', 'online', 0, '', '2343234323', 'Azam Nagar'),
(4, 'prem', '', '2023-08-30', 4500, 'gst', 'online', 0, '', '6765453465', 'Azam Nagar'),
(5, 'prem', '', '2023-08-31', 2250, 'gst', 'online', 0, '', '3454342345', 'sambra');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_data`
--

CREATE TABLE `invoice_data` (
  `id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `gst` double NOT NULL,
  `qty` double NOT NULL,
  `rate` double NOT NULL,
  `amount` double NOT NULL,
  `sgst` double NOT NULL,
  `cgst` double NOT NULL,
  `igst` double NOT NULL,
  `totalGst` double NOT NULL,
  `totalAmount` double NOT NULL,
  `inv_no` int(10) NOT NULL,
  `item_code` varchar(30) NOT NULL,
  `unitQty` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`id`, `category`, `brand`, `product`, `flavor`, `unit`, `gst`, `qty`, `rate`, `amount`, `sgst`, `cgst`, `igst`, `totalGst`, `totalAmount`, `inv_no`, `item_code`, `unitQty`) VALUES
(1, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'DARK CHOCOLATE', 'ML', 18, 2, 254.24, 508.47, 45.765, 45.765, 0, 91.53, 600, 1, '066', ''),
(2, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'DARK CHOCOLATE', 'ML', 18, 4, 254.24, 1016.95, 0, 0, 183.05, 183.05, 1200, 2, '066', '2kg'),
(3, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'CHOCOLATE', 'KG', 18, 5, 254.24, 1271.19, 114.405, 114.405, 0, 228.81, 1500, 3, '022', '5kg'),
(4, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'DARK CHOCOLATE', 'KG', 18, 5, 254.24, 1271.19, 114.405, 114.405, 0, 228.81, 1500, 4, '022', '5kg'),
(5, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'BSN’s True Mass 1200', 'CHOCOLATE', 'KG', 5, 5, 571.43, 2857.14, 71.43, 71.43, 0, 142.86, 3000, 4, '0507', '5'),
(6, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Gold Standard Whey by Optimum Nutrition', 'DARK CHOCOLATE', 'LBS', 12, 15, 133.93, 2008.93, 120.535, 120.535, 0, 241.07, 2250, 5, '55', '6');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `item_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `category`, `brand`, `product`, `flavor`, `unit`, `item_code`) VALUES
(1, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'Absolute Nutrition Mass Gainer', 'CHOCOLATE', 'KG', '0203'),
(6, 'WHEY PROTEIN', 'BSN', 'Dd', 'CHOCOLATE', 'KG', '0206'),
(8, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'BigMuscles Nutrition Real Mass Gainer', 'CHOCOLATE', 'KG', '0265'),
(9, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'BSN’s True Mass 1200', 'CHOCOLATE', 'KG', '0506'),
(10, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'BSN’s True Mass 1200', 'VANILLA', 'KG', '0507'),
(11, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Dymatize Nutrition Elite Whey Protein', 'DARK CHOCOLATE', 'ML', '555'),
(12, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Gold Standard Whey by Optimum Nutrition', 'CHOCOLATE', 'ML', '55'),
(25, 'FAT BURNERS ', 'BSN', 'BSN\'S True Mass 1200', 'CHOCOLATE', 'KG', '550'),
(26, 'MASS GAINERS', 'GAT', 'GAT Whey Protien', 'VANILLA', 'GM', '0034'),
(27, 'CASEIN PROTEIN', 'ULTIMATE NUTRIATION', 'CASEIN ', 'ORANGE', 'GM', '0789'),
(28, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Mass Tech Extreme 20', 'DARK CHOCOLATE', 'KG', '1221'),
(29, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'DARK CHOCOLATE', 'ML', '066'),
(30, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', '', '', '022'),
(31, 'VITAMINS', 'BPI', 'BSN', '', '', '001'),
(32, 'FAT BURNERS ', 'BSN', 'BSN', '', '', '123');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(1, 'Shop'),
(2, 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`) VALUES
(1, 'flexnutri@gmail.com', 'flexnutri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `id` int(10) NOT NULL,
  `basePur` double NOT NULL,
  `baseSale` double NOT NULL,
  `profitPer` double NOT NULL,
  `qty` double NOT NULL,
  `totalPfofit` double NOT NULL,
  `ivoice_id` int(10) NOT NULL,
  `ivoicedata_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profit`
--

INSERT INTO `profit` (`id`, `basePur`, `baseSale`, `profitPer`, `qty`, `totalPfofit`, `ivoice_id`, `ivoicedata_id`) VALUES
(1, 100, 254.24, 154.24, 2, 308.48, 1, 1),
(2, 100, 254.24, 154.24, 4, 616.96, 2, 2),
(3, 100, 254.24, 154.24, 5, 771.2, 3, 3),
(4, 100, 254.24, 154.24, 5, 771.2, 4, 4),
(5, 571.43, 571.43, 0, 5, 0, 4, 5),
(6, 59.52, 133.93, 74.41, 15, 1116.1499999999999, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(10) NOT NULL,
  `venName` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `totalamount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `venName`, `purchase_date`, `totalamount`) VALUES
(1, 'Akash', '2023-08-29', 1180),
(2, 'Mahesh', '2023-08-29', 1180),
(3, 'Prem', '2023-08-29', 1180),
(4, 'Ramesh', '2023-08-29', 1180),
(5, 'Ramesh', '2023-08-31', 15000),
(6, 'Ramesh', '2023-09-01', 20000),
(7, 'Akash', '2023-08-29', 30000),
(8, 'NILOFAR', '2023-08-29', 2000),
(9, 'Sagar', '2023-08-31', 64000),
(10, 'Prem', '2023-08-29', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `exp` date NOT NULL,
  `gst` double NOT NULL,
  `qty` double NOT NULL,
  `totalprice` double NOT NULL,
  `gstprice` double NOT NULL,
  `baseprice` double NOT NULL,
  `mrpprice` double NOT NULL,
  `saleprice` double NOT NULL,
  `item_code` varchar(30) NOT NULL,
  `pur_id` int(10) NOT NULL,
  `unitQty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_data`
--

INSERT INTO `purchase_data` (`id`, `category`, `brand`, `product`, `flavor`, `unit`, `location`, `exp`, `gst`, `qty`, `totalprice`, `gstprice`, `baseprice`, `mrpprice`, `saleprice`, `item_code`, `pur_id`, `unitQty`) VALUES
(1, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'DARK CHOCOLATE', 'ML', 'Shop', '2023-09-29', 18, 10, 1180, 118, 100, 500, 300, '066', 1, ''),
(2, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'CHOCOLATE', 'KG', 'Home', '2023-08-29', 18, 10, 1180, 118, 100, 500, 300, '022', 2, ''),
(3, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'CHOCOLATE', 'KG', 'Shop', '2023-08-29', 18, 10, 1180, 118, 100, 500, 300, '022', 3, '10kg'),
(4, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'DARK CHOCOLATE', 'KG', 'Home', '2023-08-29', 18, 10, 1180, 118, 100, 500, 300, '022', 4, '5kg'),
(5, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'BSN’s True Mass 1200', 'CHOCOLATE', 'KG', 'Shop', '2023-09-09', 5, 25, 15000, 600, 571.43, 700, 600, '0507', 5, '5'),
(6, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'VANILLA', 'KG', 'Shop', '2023-09-09', 5, 15, 20000, 1333.33, 1269.84, 1500, 1400, '022', 6, '10'),
(7, 'MASS GAINERS', 'GAT', 'GAT Whey Protien', 'ORANGE', 'LBS', 'Shop', '2024-06-15', 18, 40, 30000, 750, 635.59, 800, 700, '0034', 7, '0'),
(8, 'MASS GAINERS', 'GAT', 'GAT Whey Protien', 'ORANGE', 'KG', 'Shop', '2024-06-15', 5, 8, 2000, 250, 238.1, 400, 300, '0034', 8, '5kg'),
(9, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Gold Standard Whey by Optimum Nutrition', 'VANILLA', 'ML', 'Shop', '2023-09-01', 5, 5, 1000, 200, 190.48, 300, 200, '55', 9, '2'),
(10, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Mass Tech Extreme 20', 'Vanila', 'KG', 'Home', '2023-09-09', 5, 30, 2000, 66.67, 63.49, 200, 100, '1221', 9, '5'),
(11, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'VANILLA', 'LBS', 'Shop', '2023-09-08', 12, 50, 60000, 1200, 1071.43, 1200, 1100, '066', 9, '6'),
(12, 'FAT BURNERS ', 'BSN', 'BSN', 'VANILLA', 'GM', 'Shop', '2023-08-31', 12, 25, 1000, 40, 35.71, 100, 50, '123', 9, '5'),
(13, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Gold Standard Whey by Optimum Nutrition', 'DARK CHOCOLATE', 'LBS', 'Shop', '2023-09-07', 12, 30, 2000, 66.67, 59.52, 200, 150, '55', 10, '6');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `exp` date NOT NULL,
  `gst` double NOT NULL,
  `qty` double NOT NULL,
  `totalprice` double NOT NULL,
  `gstprice` double NOT NULL,
  `baseprice` double NOT NULL,
  `mrpprice` double NOT NULL,
  `saleprice` double NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `pur_id` int(10) NOT NULL,
  `unitQty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `category`, `brand`, `product`, `flavor`, `unit`, `location`, `exp`, `gst`, `qty`, `totalprice`, `gstprice`, `baseprice`, `mrpprice`, `saleprice`, `item_code`, `pur_id`, `unitQty`) VALUES
(1, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'DARK CHOCOLATE', 'ML', 'Shop', '2023-09-29', 18, 4, 1180, 118, 100, 500, 300, '066', 1, '2kg'),
(2, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'CHOCOLATE', 'KG', 'Home', '2023-08-29', 18, 5, 1180, 118, 100, 500, 300, '022', 2, '5kg'),
(3, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'CHOCOLATE', 'KG', 'Shop', '2023-08-29', 18, 10, 1180, 118, 100, 500, 300, '022', 3, '10kg'),
(4, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'DARK CHOCOLATE', 'KG', 'Home', '2023-08-29', 18, 5, 1180, 118, 100, 500, 300, '022', 4, '5kg'),
(5, 'WHEY PROTEIN', 'OPTIMUM NUTRIATION', 'BSN’s True Mass 1200', 'CHOCOLATE', 'KG', 'Shop', '2023-09-09', 5, 20, 15000, 600, 571.43, 700, 600, '0507', 5, '5'),
(6, 'MASS GAINERS', 'OPTIMUM NUTRIATION', 'Mass', 'VANILLA', 'KG', 'Shop', '2023-09-09', 5, 15, 20000, 1333.33, 1269.84, 1500, 1400, '022', 6, '10'),
(7, 'MASS GAINERS', 'GAT', 'GAT Whey Protien', 'ORANGE', 'LBS', 'Shop', '2024-06-15', 18, 40, 30000, 750, 635.59, 800, 700, '0034', 7, '0'),
(8, 'MASS GAINERS', 'GAT', 'GAT Whey Protien', 'ORANGE', 'KG', 'Shop', '2024-06-15', 5, 8, 2000, 250, 238.1, 400, 300, '0034', 8, '5kg'),
(9, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Gold Standard Whey by Optimum Nutrition', 'VANILLA', 'ML', 'Shop', '2023-09-01', 5, 5, 1000, 200, 190.48, 300, 200, '55', 9, '2'),
(10, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Mass Tech Extreme 20', 'Vanila', 'KG', 'Home', '2023-09-09', 5, 30, 2000, 66.67, 63.49, 200, 100, '1221', 9, '5'),
(11, 'WHEY PROTEIN', 'BSN', 'Mass Gainer', 'VANILLA', 'LBS', 'Shop', '2023-09-08', 12, 50, 60000, 1200, 1071.43, 1200, 1100, '066', 9, '6'),
(12, 'FAT BURNERS ', 'BSN', 'BSN', 'VANILLA', 'GM', 'Shop', '2023-08-31', 12, 25, 1000, 40, 35.71, 100, 50, '123', 9, '5'),
(13, 'MASS GAINERS', 'ULTIMATE NUTRIATION', 'Gold Standard Whey by Optimum Nutrition', 'DARK CHOCOLATE', 'LBS', 'Shop', '2023-09-07', 12, 15, 2000, 66.67, 59.52, 200, 150, '55', 10, '6');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) NOT NULL,
  `unitName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unitName`) VALUES
(1, 'KG'),
(2, 'ML'),
(3, 'LBS'),
(4, 'GM'),
(5, 'Mg');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `venName` varchar(50) NOT NULL,
  `venGst` varchar(30) NOT NULL,
  `venMobile` varchar(10) NOT NULL,
  `venAdds` varchar(100) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `venName`, `venGst`, `venMobile`, `venAdds`, `status`) VALUES
(1, 'Suraj', '', '9620625775', 'Dharwad', 0),
(2, 'Ramesh', '', '7676801529', 'Belgaum', 0),
(3, 'Mahesh', '', '9019552925', 'Hubali', 0),
(4, 'Sagar', '', '9730782892', 'Azam Nagar', 0),
(5, 'Akash', '', '2343567867', 'Shahu Nagar', 0),
(6, 'Prem', '', '9731308868', 'Azam nagar', 0),
(7, 'Ram', '', '7353231800', 'Shahu nagar', 0),
(8, 'NILOFAR', '', '2312321234', 'SAMBRA', 0),
(9, 'FG', '', '0000000008', 'TYIK', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `flavor`
--
ALTER TABLE `flavor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst`
--
ALTER TABLE `gst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_data`
--
ALTER TABLE `invoice_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_item_code` (`item_code`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_data`
--
ALTER TABLE `purchase_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flavor`
--
ALTER TABLE `flavor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gst`
--
ALTER TABLE `gst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_data`
--
ALTER TABLE `invoice_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
