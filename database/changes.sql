-- @Veda 2023-02-09: changed the foreign key to customer instead of user;
ALTER TABLE `product_ratings` CHANGE `fkRoleId` `fkCustomerID` INT(11) NOT NULL; 
ALTER TABLE `product_ratings` DROP FOREIGN KEY `product_ratings_ibfk_2`; 
ALTER TABLE `product_ratings` ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`fkCustomerID`) REFERENCES `customer`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- @Veda 2023-02-10: created category table and linked to product table;
CREATE TABLE user_role (id int NOT NULL, title varchar (255), img varchar (255), desciption txt, status char (3) default 'I', PRIMARY KEY (id) );
ALTER TABLE product ADD categoryId int;
ALTER TABLE product ADD FOREIGN KEY (categoryId) REFERENCES category(id);

-- @Veda 2023-02-15: changed product stock table by adding auto increment;
ALTER TABLE `product_stock` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- @Veda 2023-02-23: changed officeAddress to title; 
ALTER TABLE `customer_address` CHANGE `officeAddress` `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- @Veda 2023-02-23: changed homeAddress to address; 
ALTER TABLE `customer_address` CHANGE `homeAddress` `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- @Veda 2023-02-23: auto increment id
ALTER TABLE `customer_address` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `customer_cart` CHANGE `cartItems` `qty` INT NULL;

-- @Veda 2023-02-24: added column in order_status table
ALTER TABLE order_status ADD comments text;
-- @Veda 2023-02-24: auto increment id
ALTER TABLE `order_item` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `customer_cart` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
