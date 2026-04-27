-- Create the database and use it
CREATE DATABASE IF NOT EXISTS `chiikamart_db`;
USE `chiikamart_db`;

-- =======================================================================
-- GROUP 1: INDEPENDENT TABLES (The Parents)
-- These have no foreign keys, so they must be created first!
-- =======================================================================

CREATE TABLE `tbl_roles` (
  `roleID` INT(11) NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(20) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_characters` (
  `characterID` INT(11) NOT NULL AUTO_INCREMENT,
  `charName` VARCHAR(50) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`characterID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_collections` (
  `collectionID` INT(11) NOT NULL AUTO_INCREMENT,
  `collectionName` VARCHAR(100) NOT NULL,
  `isFeatured` TINYINT(1) NOT NULL DEFAULT 0,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collectionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_order_statuses` (
  `statusID` INT(11) NOT NULL AUTO_INCREMENT,
  `statusName` VARCHAR(50) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- =======================================================================
-- GROUP 2: LEVEL 1 DEPENDENCIES (The Children)
-- =======================================================================

CREATE TABLE `tbl_users` (
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `suffix` VARCHAR(10) DEFAULT NULL,
  `birthday` DATE DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phoneNumber` VARCHAR(20) NOT NULL,
  `street` VARCHAR(150) NOT NULL,
  `barangay` VARCHAR(50) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `province` VARCHAR(50) NOT NULL,
  `zipCode` VARCHAR(10) NOT NULL,
  `roleID` INT(11) NOT NULL DEFAULT 2,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email_unique` (`email`),
  FOREIGN KEY (`roleID`) REFERENCES `tbl_roles` (`roleID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_products` (
  `productID` INT(11) NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `stockQuantity` INT(11) NOT NULL DEFAULT 0,
  `characterID` INT(11) NOT NULL,
  `collectionID` INT(11) DEFAULT NULL,
  `imageURL` VARCHAR(255) DEFAULT NULL,
  `isFeatured` TINYINT(1) NOT NULL DEFAULT 0,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`productID`),
  FOREIGN KEY (`characterID`) REFERENCES `tbl_characters`(`characterID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`collectionID`) REFERENCES `tbl_collections`(`collectionID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- =======================================================================
-- GROUP 3: LEVEL 2 DEPENDENCIES (The Grandchildren)
-- =======================================================================

CREATE TABLE `tbl_cart_items` (
  `cartID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `productID` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL DEFAULT 1,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cartID`),
  FOREIGN KEY (`userID`) REFERENCES `tbl_users`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`productID`) REFERENCES `tbl_products`(`productID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_wishlists` (
  `wishlistID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `productID` INT(11) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`wishlistID`),
  FOREIGN KEY (`userID`) REFERENCES `tbl_users`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`productID`) REFERENCES `tbl_products`(`productID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_reviews` (
  `reviewID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `productID` INT(11) NOT NULL,
  `ratingValue` DECIMAL(2,1) NOT NULL,
  `reviewText` TEXT DEFAULT NULL,
  `isApproved` TINYINT(1) NOT NULL DEFAULT 1,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewID`),
  FOREIGN KEY (`userID`) REFERENCES `tbl_users`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`productID`) REFERENCES `tbl_products`(`productID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_orders` (
  `orderID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `totalAmount` DECIMAL(10,2) NOT NULL,
  `shippingAddress` TEXT NOT NULL,
  `statusID` INT(11) NOT NULL,
  `orderDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderID`),
  FOREIGN KEY (`userID`) REFERENCES `tbl_users`(`userID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`statusID`) REFERENCES `tbl_order_statuses`(`statusID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- =======================================================================
-- GROUP 4: LEVEL 3 DEPENDENCIES (The Great-Grandchildren)
-- =======================================================================

CREATE TABLE `tbl_order_items` (
  `itemID` INT(11) NOT NULL AUTO_INCREMENT,
  `orderID` INT(11) NOT NULL,
  `productID` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `priceAtPurchase` DECIMAL(10,2) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemID`),
  FOREIGN KEY (`orderID`) REFERENCES `tbl_orders`(`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`productID`) REFERENCES `tbl_products`(`productID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;