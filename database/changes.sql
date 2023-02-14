-- @Veda 2023-02-09: changed the foreign key to customer instead of user;
ALTER TABLE `product_ratings` CHANGE `fkRoleId` `fkCustomerID` INT(11) NOT NULL; 
ALTER TABLE `product_ratings` DROP FOREIGN KEY `product_ratings_ibfk_2`; 
ALTER TABLE `product_ratings` ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`fkCustomerID`) REFERENCES `customer`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- @Veda 2023-02-10: created category table and linked to product table;
CREATE TABLE user_role (id int NOT NULL, title varchar (255), img varchar (255), desciption txt, status char (3) default 'I', PRIMARY KEY (id) );
ALTER TABLE product ADD categoryId int;
ALTER TABLE product ADD FOREIGN KEY (categoryId) REFERENCES category(id);