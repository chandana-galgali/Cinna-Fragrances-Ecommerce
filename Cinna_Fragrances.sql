-- Create Database
CREATE DATABASE IF NOT EXISTS perfume_store;
USE perfume_store;

-- Table structure for table `accounts`
CREATE TABLE `accounts` (
  `aid` INT NOT NULL AUTO_INCREMENT,
  `afname` VARCHAR(100) NOT NULL,
  `alname` VARCHAR(100) NOT NULL,
  `phone` CHAR(10) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `dob` DATE NOT NULL,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `gender` VARCHAR(10) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `accounts` table
INSERT INTO `accounts` (`afname`, `alname`, `phone`, `email`, `dob`, `username`, `gender`, `password`) VALUES
('Cinna', 'Ryams', '3150100830', 'cinna.r@cinnafrag.com', '1985-05-03', 'admin', 'F', 'admin123'),
('James', 'Dean', '3212547896', 'james@cinnafrag.com', '1990-02-16', 'jamesd', 'M', 'marketing123'),
('Olivia', 'White', '3456789123', 'olivia@cinnafrag.com', '1992-03-22', 'oliviaw', 'F', 'support789');

-- Table structure for table `products`
CREATE TABLE `products` (
  `pid` INT NOT NULL AUTO_INCREMENT,
  `pname` VARCHAR(100) NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  `price` INT NOT NULL,
  `qtyavail` INT NOT NULL,
  `img` VARCHAR(255) NOT NULL,
  `brand` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert 20 perfume products into the `products` table
INSERT INTO `products` (`pname`, `category`, `description`, `price`, `qtyavail`, `img`, `brand`) VALUES
('Cinna Noir', 'Eau de Parfum', 'A bold and long-lasting fragrance with rich undertones of blackcurrant and musk.', 250, 15, 'cinna_noir.jpg', 'Cinna Fragrances'),
('Floral Essence', 'Eau de Toilette', 'A refreshing floral scent with notes of jasmine and rose.', 150, 25, 'floral_essence.jpg', 'Cinna Fragrances'),
('Citrus Zest', 'Eau de Cologne', 'An energizing blend of citrus and herbal notes.', 130, 30, 'citrus_zest.jpg', 'Cinna Fragrances'),
('Ocean Breeze', 'Eau de Parfum', 'A revitalizing aquatic fragrance with sea salt and lemon undertones.', 230, 20, 'ocean_breeze.jpg', 'Cinna Fragrances'),
('Vanilla Dream', 'Eau de Parfum', 'Warm and inviting vanilla scent, perfect for cozy evenings.', 200, 18, 'vanilla_dream.jpg', 'Cinna Fragrances'),
('Spice Mystique', 'Eau de Toilette', 'A rich, spicy fragrance with hints of cinnamon and cloves.', 160, 10, 'spice_mystique.jpg', 'Cinna Fragrances'),
('Amber Nights', 'Eau de Parfum', 'An intense amber fragrance with hints of sandalwood and patchouli.', 280, 12, 'amber_nights.jpg', 'Cinna Fragrances'),
('Rose Delight', 'Eau de Toilette', 'A soft and romantic rose fragrance with a hint of fresh greenery.', 145, 22, 'rose_delight.jpg', 'Cinna Fragrances'),
('Cedar Wood', 'Eau de Cologne', 'A woody scent with a blend of cedar and fresh pine notes.', 170, 15, 'cedar_wood.jpg', 'Cinna Fragrances'),
('Lavender Calm', 'Eau de Parfum', 'A calming lavender fragrance, perfect for relaxation.', 200, 18, 'lavender_calm.jpg', 'Cinna Fragrances'),
('Exotic Oud', 'Eau de Parfum', 'A luxurious oud fragrance with smoky and earthy undertones.', 300, 7, 'exotic_oud.jpg', 'Cinna Fragrances'),
('Jasmine Bloom', 'Eau de Toilette', 'A refreshing jasmine fragrance for daily wear.', 150, 28, 'jasmine_bloom.jpg', 'Cinna Fragrances'),
('Musk Classic', 'Eau de Cologne', 'A timeless musk fragrance, subtle yet enticing.', 180, 17, 'musk_classic.jpg', 'Cinna Fragrances'),
('Patchouli Spice', 'Eau de Parfum', 'An exotic patchouli fragrance with warm spice notes.', 250, 13, 'patchouli_spice.jpg', 'Cinna Fragrances'),
('Peony Blush', 'Eau de Toilette', 'A floral fragrance with hints of peony and soft fruit notes.', 160, 26, 'peony_blush.jpg', 'Cinna Fragrances'),
('Sandalwood Silk', 'Eau de Parfum', 'A smooth sandalwood scent with silky undertones.', 270, 11, 'sandalwood_silk.jpg', 'Cinna Fragrances'),
('Coco Vanilla', 'Eau de Parfum', 'A tropical blend of coconut and vanilla, ideal for warm weather.', 190, 20, 'coco_vanilla.jpg', 'Cinna Fragrances'),
('Mint Fresh', 'Eau de Cologne', 'A fresh minty fragrance with a twist of eucalyptus.', 140, 18, 'mint_fresh.jpg', 'Cinna Fragrances'),
('Oriental Spice', 'Eau de Parfum', 'A rich oriental fragrance with exotic spices.', 260, 9, 'oriental_spice.jpg', 'Cinna Fragrances'),
('Ginger Lemon', 'Eau de Toilette', 'A zesty blend of ginger and lemon for a fresh start.', 130, 24, 'ginger_lemon.jpg', 'Cinna Fragrances');

-- Table structure for table `orders`
CREATE TABLE `orders` (
  `oid` INT NOT NULL AUTO_INCREMENT,
  `dateod` DATE NOT NULL,
  `datedel` DATE DEFAULT NULL,
  `aid` INT NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `country` VARCHAR(100) NOT NULL,
  `account` CHAR(16) DEFAULT NULL,
  `total` INT NOT NULL,
  PRIMARY KEY (`oid`),
  FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `orders` table
INSERT INTO `orders` (`dateod`, `datedel`, `aid`, `address`, `city`, `country`, `account`, `total`) VALUES
('2023-05-15', '2023-05-15', 1, '123 Fragrance St, Scent City', 'New York', 'USA', NULL, 180),
('2023-05-15', '2023-05-15', 2, '456 Aroma Lane', 'Los Angeles', 'USA', NULL, 150);

-- Table structure for table `order-details`
CREATE TABLE `order-details` (
  `oid` INT NOT NULL,
  `pid` INT NOT NULL,
  `qty` INT NOT NULL,
  PRIMARY KEY (`oid`, `pid`),
  FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `order-details` table
INSERT INTO `order-details` (`oid`, `pid`, `qty`) VALUES
(1, 1, 2),
(2, 2, 1);

-- Table structure for table `cart`
CREATE TABLE `cart` (
  `aid` INT NOT NULL,
  `pid` INT NOT NULL,
  `cqty` INT NOT NULL,
  PRIMARY KEY (`aid`, `pid`),
  FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `wishlist`
CREATE TABLE `wishlist` (
  `aid` INT NOT NULL,
  `pid` INT NOT NULL,
  PRIMARY KEY (`aid`, `pid`),
  FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `wishlist` table
INSERT INTO `wishlist` (`aid`, `pid`) VALUES
(1, 1),
(2, 2);

-- Table structure for table `reviews`
CREATE TABLE `reviews` (
  `oid` INT NOT NULL,
  `pid` INT NOT NULL,
  `rtext` VARCHAR(1000) DEFAULT NULL,
  `rating` INT CHECK (`rating` BETWEEN 1 AND 5),
  PRIMARY KEY (`oid`, `pid`),
  FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `reviews` table
INSERT INTO `reviews` (`oid`, `pid`, `rtext`, `rating`) VALUES
(1, 1, 'Absolutely love this perfume! Long-lasting and smells divine.', 5),
(2, 2, 'Perfect for everyday wear, light and refreshing.', 4);