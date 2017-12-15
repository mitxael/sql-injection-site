-- Create table categories
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
);

-- Create table products
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `qty_left` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_category` (`id`),
  KEY `category` (`category`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Create table permissions
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
);

-- Create table members
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_member_permission` (`permission`),
  CONSTRAINT `fk_member_permission` FOREIGN KEY (`permission`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Create table orders
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `member` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_member` (`member`),
  CONSTRAINT `fk_order_member` FOREIGN KEY (`member`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Create table ordersline
CREATE TABLE `orderlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orderline_product` (`product`),
  KEY `fk_orderline_order` (`order`),
  CONSTRAINT `fk_orderline_product` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orderline_order` FOREIGN KEY (`order`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Create table payments
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creditcard_number` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orderline_order` (`order`),
  CONSTRAINT `fk_payment_order` FOREIGN KEY (`order`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);