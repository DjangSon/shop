-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-25 04:41:36
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `address`
--

CREATE TABLE `address` (
  `id` int(4) NOT NULL,
  `recivename` varchar(20) NOT NULL COMMENT '收货人姓名',
  `mobile` varchar(12) NOT NULL COMMENT '收货人手机',
  `postal` varchar(8) NOT NULL COMMENT '邮政编码',
  `identity` varchar(18) NOT NULL COMMENT '身份证号',
  `address` varchar(70) NOT NULL COMMENT '收货地址',
  `flag` int(4) NOT NULL COMMENT '用户ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `address`
--

INSERT INTO `address` (`id`, `recivename`, `mobile`, `postal`, `identity`, `address`, `flag`) VALUES
(5, '吴晓芳', '15759313113', '352100', '350128199401112920', '宁德师范学院1S523', 6);

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `ID` int(4) NOT NULL,
  `adminName` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`ID`, `adminName`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- 表的结构 `brand`
--

CREATE TABLE `brand` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `cname` varchar(20) NOT NULL COMMENT '中文品牌名'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- 转存表中的数据 `brand`
--

INSERT INTO `brand` (`id`, `name`, `cname`) VALUES
(17, 'whoo', '后');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `goods_id` int(20) NOT NULL,
  `goods_price` int(10) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`id`, `mobile`, `goods_id`, `goods_price`, `time`) VALUES
(1, '18150850025', 33, 109, '2016-04-19 21:04:22'),
(3, '', 33, 109, '2016-04-20 15:04:14');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(4) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `function`
--

CREATE TABLE `function` (
  `id` int(4) NOT NULL,
  `name` varchar(44) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE `goods` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `category` varchar(40) NOT NULL,
  `price` int(10) NOT NULL,
  `type` varchar(60) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `cbrand` varchar(50) NOT NULL,
  `function` varchar(50) NOT NULL,
  `picture01` varchar(255) NOT NULL,
  `picture02` varchar(255) NOT NULL,
  `picture03` varchar(255) NOT NULL,
  `picture04` varchar(255) NOT NULL,
  `described` text NOT NULL,
  `describe_pic` varchar(255) NOT NULL,
  `top3_pic` varchar(50) NOT NULL,
  `product_pic` varchar(50) NOT NULL,
  `addtime` datetime NOT NULL,
  `crazy` tinyint(1) NOT NULL DEFAULT '0',
  `top3` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- 表的结构 `onsale`
--

CREATE TABLE `onsale` (
  `id` int(20) NOT NULL,
  `name` text NOT NULL,
  `discount` int(10) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- 转存表中的数据 `onsale`
--

INSERT INTO `onsale` (`id`, `name`, `discount`, `starttime`, `endtime`) VALUES
(3, '五一活动', 7, '2016-04-14 18:53:49', '2016-04-14 18:04:03'),
(4, '六一活动', 8, '2016-04-14 18:54:12', '2016-04-19 14:04:59');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `receiver` varchar(20) NOT NULL COMMENT '收货人',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `goods_id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `piece` int(5) NOT NULL,
  `pay` tinyint(1) NOT NULL DEFAULT '0',
  `express` varchar(12) NOT NULL,
  `dealtime` datetime NOT NULL,
  `receive` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(100) DEFAULT NULL COMMENT '评论'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(20) NOT NULL,
  `qq` varchar(13) NOT NULL,
  `address` varchar(100) NOT NULL,
  `regtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `realname`, `mobile`, `password`, `email`, `qq`, `address`, `regtime`, `flag`) VALUES
(5, '老王', '18150850025', 'e10adc3949ba59abbe56e057f20f883e', '1261521614@email.com', '1252532562', '贵州省兰州市', '2016-04-13 20:49:14', 0),
(6, '吴晓芳', '15759313113', '6ebe76c9fb411be97b3b0d48b791a7c9', '', '', '是到付件快递发货', '2016-04-16 15:40:43', 0),
(9, '', '18150850035', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '2016-04-19 17:02:34', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onsale`
--
ALTER TABLE `onsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `address`
--
ALTER TABLE `address`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `function`
--
ALTER TABLE `function`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `onsale`
--
ALTER TABLE `onsale`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
