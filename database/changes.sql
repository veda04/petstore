-- @Veda 2023-02-09: changed the foreign key to customer instead of user;
ALTER TABLE `product_ratings` CHANGE `fkRoleId` `fkCustomerID` INT(11) NOT NULL; 
ALTER TABLE `product_ratings` DROP FOREIGN KEY `product_ratings_ibfk_2`; 
ALTER TABLE `product_ratings` ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`fkCustomerID`) REFERENCES `customer`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;