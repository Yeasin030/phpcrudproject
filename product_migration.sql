ALTER TABLE `items`
  ADD COLUMN `category` varchar(100) NOT NULL DEFAULT '' AFTER `name`,
  MODIFY COLUMN `price` decimal(10,2) NOT NULL,
  ADD COLUMN `status` varchar(30) NOT NULL DEFAULT 'Active' AFTER `description`;